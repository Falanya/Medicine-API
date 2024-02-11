<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductType;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Product $product) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        $address = Address::orderBy('id','ASC')->where('user_id',$auth->id)->get();
        $address_count = $auth->addresses->count();
        $carts = Cart::orderBy('created_at','DESC')->where('user_id', $auth->id)->get();
        return view('checkout', compact('proTypes','auth', 'address',  'address_count','carts'));
    }

    public function post_checkout(Request $request) {
        $auth = auth()->user();
        $request->validate([
            'address_id' => 'bail|required',
            'note' => 'max:500'
        ]);
        $data = $request->only('address_id','note');
        if ($order = Order::create($data)) {
            foreach($auth->carts as $cart) {
                $data_order = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price 
                ];
                ProductOrder::create($data_order);
                Cart::where('user_id', $auth->id)->delete();
            }
        }
    }
}
