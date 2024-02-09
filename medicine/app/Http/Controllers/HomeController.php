<?php

namespace App\Http\Controllers;

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
        return view('product', compact('product','proTypes'));
    }

    public function productType(ProductType $productType) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $products = Product::where('type_id', $productType->id)->where('status', 1)->get();
        return view('productType', compact('productType', 'proTypes', 'products'));
    }

    public function post_comment() {
        
    }
}
