<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Product $product) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        $address = Address::orderBy('id','ASC')->where('user_id',$auth->id)->get();
        $carts = Cart::orderBy('created_at','DESC')->where('user_id', $auth->id)->get();
        return view('checkout', compact('proTypes','auth', 'address','carts'));
    }

    public function post_checkout() {

    }
}
