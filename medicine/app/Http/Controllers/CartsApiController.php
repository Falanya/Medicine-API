<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartsApiController extends Controller
{
    public function index() {
        return view('cart');
    }

    public function add_cart(Product $product, Request $request) {
        $user_id = auth()->user()->id;
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $data = [
            'user_id' => $user_id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
        ];
        dd($data);
    }

    public function update_cart(Product $product, Request $request) {

    }

    public function delete_cart(Product $product) {

    }

    public function clear_cart() {

    }
}
