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
        $address = $auth->addresses;
        $cart = $auth->carts;
        return response()->json([
            'addresses' => $address,
            'cart' => $cart,
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
            $cusInfo = $order->user;
            $reInfo = $order->address;
            $orderInfo = [
                'totalPrice' => number_format($order->totalPrice),
                'note' => $order->note,
                'created_at' => $order->created_at->format('d/m/Y')
            ];
            $products = [];

            foreach($order->details as $item) {
                $product = [
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
                'products' => $products
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
