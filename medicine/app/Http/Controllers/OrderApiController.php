<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
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
        foreach($auth_cart as $key => $item) {
            $cart = [
                'STT' => $key + 1,
                'name' => $item->product->name,
                'img' => $item->product->img,
                'quantity' => $item->quantity,
                'price' => $item->price
            ];
            $carts[] = $cart;
        }

        return response()->json([
            'addresses' => $addresses,
            'carts' => $carts,
        ]);
    }

    public function history() {
        $auth = auth()->user();
        $order_list = $auth->orders;
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
                'receiver_name' => $address->receiver_name,
                'phone' => $address->phone,
                'address' => $address->address
            ];
            $orderInfo = [
                'totalPrice' => number_format($order->totalPrice),
                'note' => $order->note,
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
            'confirm_password' => ['bail', 'required', function($attr,$value,$fail) use($auth) {
                if(!Hash::check($value, $auth->password)) {
                    $fail('Your password is incorrect, please try again');
                }
            }]
        ], [
            'address_id.exists' => "The address you selected doesn't invalid"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 404
            ]);
        }

        $data = $request->only('address_id','note');
        $data['user_id'] = $auth->id;

        if ($auth->carts()->count() > 0) {
        
            $creOrder = Order::create($data);

            if($creOrder) {
                $token = Str::random(40);

                foreach($auth->carts as $cart) {
                    $data_order = [
                        'order_id' => $creOrder->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price' => $cart->price
                    ];
                    ProductOrder::create($data_order);
                };

                $auth->carts()->delete();

                $creOrder->token = $token;
                $creOrder->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $creOrder->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $creOrder->save();

                return response()->json([
                    'message' => 'The order created succressfully',
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
}
