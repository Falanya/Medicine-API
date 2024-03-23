<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderMailApi;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderApiController extends Controller
{
    public function show_checkout() {
        $auth = auth()->user();
        $auth_address = $auth->addresses;
        $addresses = [];
        foreach($auth_address as $item) {
            $address = [
                'id' => $item->id,
                'receiver_name' => $item->receiver_name,
                'phone' => $item->phone,
                'address' => $item->address,
                'object_status' => $item->object_status,
            ];
            $addresses[] = $address;
        }

        $auth_cart = $auth->carts;
        $carts = [];
        $total = 0;
        foreach($auth_cart as $key => $item) {
            $price = $item->product->discount > 0 && $item->product->discount < $item->product->price ? $item->product->discount : $item->product->price;
            $total += $price*$item->quantity;
            $cart = [
                'STT' => $key + 1,
                'id' => $item->id,
                'name' => $item->product->name,
                'img' => $item->product->img,
                'quantity' => $item->quantity,
                'price' => number_format($price),
                'status' => $item->status == 1 ? 'Show' : 'Hidden',
            ];
            $carts[] = $cart;
        }

        return response()->json([
            'address_default' => $auth->address,
            'addresses' => $addresses,
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function history() {
        $auth = auth()->user();
        $auth_order = $auth->orders;
        $order_list = [];
        $statusOrder = [
            0 => 'Chưa xác minh email',
            1 => 'Đã xác minh email',
            2 => 'Đang vận chuyển',
            3 => 'Đã hoàn thành',
            4 => 'Đã hủy',
        ];
        foreach($auth_order as $item) {
            $order = [
                'id' => $item->id,
                'tracking_number' => $item->tracking_number,
                'order_date' => $item->created_at->format('d/m/Y'),
                'status_content' => $statusOrder[$item->status] ?? '',
                'status' => $item->status,
                'totalPrice' => $item->totalPrice
            ];
            $order_list[] = $order;
        }
        return response()->json([
            'data' => $order_list,
            'status_code' => 200,
            'message' => 'Success'
        ]);
    }

    public function detail(Order $order) {
        $auth = auth()->user();
        if ($auth->id == $order->user_id) {
            $user = $order->user;
            $cusInfo = [
                'fullname' => $user->fullname,
                'email' => $user->email,
            ];
            $address = $order->address;
            $reInfo = [
                'address_default' => $order->address,
                'receiver_name' => $address->receiver_name,
                'phone' => $address->phone,
                'address' => $address->address
            ];
            $statusOrder = [
                0 => 'Not Verified',
                1 => 'Verified',
                2 => 'Shipping',
                3 => 'Completed',
                4 => 'Cancelled'
            ];
            $orderInfo = [
                'tracking_number' => $order->tracking_number,
                'discount' => number_format($order->discountPrice),
                'totalPrice' => number_format($order->totalPrice),
                'note' => $order->note,
                'status_content' => $statusOrder[$order->status] ?? '',
                'status' => $order->status,
                'created_at' => $order->created_at->format('d/m/Y')
            ];
            $products = [];

            foreach($order->details as $key => $item) {
                $product = [
                    'STT' => $key + 1,
                    'name' => $item->product->name,
                    'img' => $item->product->img,
                    'quantity' => $item->quantity,
                    'price' => number_format($item->price)
                ];
                $products[] = $product;
            }

            return response()->json([
                'cusInfo' => $cusInfo,
                'reInfo' => $reInfo,
                'orderInfo' => $orderInfo,
                'products' => $products,
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Your order cannot be found"
            ]);
        }

    }

    public function post_checkout(Request $request) {
        $auth = auth()->user();
        $validator = Validator::make($request->all(), [
            'address_id' => 'bail|required|exists:addresses,id',
            'note' => 'max:255',
            'promotion_code' => ['nullable', 'exists:promotions,code', function($attr,$value,$fail) use($auth) {
                $promotion = Promotion::where('code', $value)->first();
                if($promotion) {
                    $now = Carbon::now('Asia/Ho_Chi_Minh');
                    $startsAt = Carbon::createFromFormat('Y-m-d H:i:s', $promotion->starts_at);
                    $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $promotion->expires_at);

                    if($promotion->status == 0) {
                        $fail('Voucher is not active');
                    }

                    if($now->lt($startsAt)) {
                        $fail('Voucher can only used from '. $startsAt);
                    }

                    if($expiresAt->lt($now)) {
                        $fail('Voucher had expired');
                    }

                    if(empty($promotion->max_users)) {
                        $fail('Voucher had expirdd');
                    }

                    if($promotion->min_amount != null) {
                        if($auth->carts->count() > 0) {
                            $totalCart = 0;
                            foreach($auth->carts as $item) {
                                $price = $item->product->discount > 0 && $item->product->discount < $item->product->price ? $item->product->discount : $item->product->price;
                                $totalCart += $price * $item->quantity;
                            }
                            if($totalCart < $promotion->min_amount) {
                                $fail('Order has not reached minumum amount, missing '. number_format($promotion->min_amount - $totalCart));
                            }
                        }
                    }
                }
            }],
        ], [
            'address_id.exists' => "The address you selected doesn't invalid"
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 404
            ]);
        }

        $data = $request->only('address_default','address_id','note','promotion_code');
        $data['user_id'] = $auth->id;
        $date = Carbon::now('Asia/Ho_Chi_Minh');
        $dateformat = $date->format('dmYhis');
        $data['tracking_number'] = $dateformat.$auth->id;
        $cart = $auth->carts;
        if ($auth->carts()->count() > 0) {

            foreach($auth->carts as $cart) {
                $product = $cart->product;
                if($product->quantity < $cart->quantity) {
                    return response()->json([
                        'message' => 'Some products is sold out, please try again',
                        'status_code' => 400,
                    ]);
                }
            }

            $order = Order::create($data);

            if($order) {
                $token = Str::random(40);

                foreach($auth->carts as $key => $cart) {
                    $price = $cart->product->discount > 0 && $cart->product->discount < $cart->product->price ? $cart->product->discount : $cart->product->price;
                    $data_order = [
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $price
                    ];

                    ProductOrder::create($data_order);
                    $cart->status = 0;
                    $cart->save();
                };
                // $auth->cart->delete();
                $order->token = $token;
                $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $order->save();

                $promotion = Promotion::where('code', $order->promotion_code)->first();
                if($promotion) {
                    if(!empty($promotion->max_users)) {
                        $promotion->max_users -= 1;
                        $promotion->save();
                    }
                }

                Mail::to($auth->email)->send(new OrderMailApi($order,$token));

                return response()->json([
                    'message' => 'The order created succressfully, please check mail to verify',
                    'status_code' => 200,
                ]);
            }

            return response()->json([
                'message' => 'Something errors, please check again',
                'status_code' => 404,
            ]);
        } else {
            return response()->json([
                'message' => 'Your cart is empty, please add product to create order',
                'status_code' => 404
            ]);
        }
    }

    public function verify($token) {
        $order = Order::where('token', $token)->firstOrFail();
        if($order) {
            $order->token = null;
            $order->status = 1;
            $order->save();

            return 'Verify your order successfully';
        }
        return 'Cannot found order, please check again';
    }
}
