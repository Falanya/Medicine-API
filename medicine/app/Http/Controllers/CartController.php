<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;

class CartController extends Controller
{
    public function index(Product $product) {
        $user = auth()->user()->id;
        $count_cart = Cart::where([
            'user_id' => $user,
        ])->count();
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $carts = Cart::orderBy('created_at','DESC')->where(['user_id' => $user, 'status' => 1])->get();
        return view('cart', compact('carts','proTypes','count_cart'));
    }

    public function add_cart(Product $product, Request $request) {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $user_id = auth()->id();
        $cartExists = Cart::where([
            'user_id' => $user_id,
            'product_id' => $product->id,
            'status' => 1,
        ])->first();
        if ($cartExists) {
            Cart::where([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'status' => 1,
            ])->increment('quantity', $quantity);
        } else {
            $data = [
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
            if(Cart::create($data)) {
                return redirect()->back();
            }
        }
        return redirect()->back();
        
    }

    public function plus_1_product(Product $product, Request $request) {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $user = auth()->user()->id;
        Cart::where([
            'user_id' => $user,
            'product_id' => $product->id
        ])->increment('quantity', $quantity);
        return redirect()->back();
    }

    public function minus_1_product(Product $product, Request $request) {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $user = auth()->user()->id;
        $quantity_check = Cart::where([
            'user_id' => $user,
            'product_id' => $product->id
        ])->first();
        if($quantity_check->quantity > 1) {
            Cart::where([
                'user_id' => $user,
                'product_id' => $product->id
            ])->decrement('quantity', $quantity);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function delete_cart(Product $product) {
        $user_id = auth()->user()->id;
        $cart = Cart::where([
            'user_id' => $user_id,
            'product_id' => $product->id,
            'status' => 1,
        ])->first();
        $cart->status = 0;
        $cart->save();
        return redirect()->back()->with('success','Product deleted from cart');
    }

    public function clear_cart() {
        $user_id = auth()->user()->id;
        $carts = Cart::where([
            'user_id' => $user_id,
            'status' => 1,
        ])->get();
        foreach($carts as $key => $cart) {
            $cart->status = 0;
            $cart->save();
        }
        return redirect()->back()->with('success','All products deleted from cart');
    }
}