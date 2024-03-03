<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $pros = Product::orderBy('id','DESC')->where('status', 1)->get();
        return view('index', compact('proTypes','pros'));
    }

    public function about() {
        return view('about');
    }

    public function product(Product $product) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $comments = Comment::where('product_id', $product->id)->orderBy('id','DESC')->get();
        return view('product', compact('product','proTypes', 'comments'));
    }

    public function productType(ProductType $productType) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $products = Product::where('type_id', $productType->id)->where('status', 1)->get();
        return view('productType', compact('productType', 'proTypes', 'products'));
    }

    public function post_comment($product, Request $request) {
        $request->validate([
            'comment' => 'required|string|min:10|max:255',
        ]);
        $data = $request->only('comment');
        $data['user_id'] = auth()->user()->id;
        $data['product_id'] = $product;
        $check = Comment::create($data);
        if($check) {
            return redirect()->back();
        }
        return redirect()->back();
    }
}
