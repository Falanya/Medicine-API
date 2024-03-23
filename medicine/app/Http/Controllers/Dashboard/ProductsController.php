<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function list_products() {
        $config = 'dashboard.products.index';
        $auth = auth()->user();
        $products = Product::orderBy('id','DESC')->paginate(10);
        return view('dashboard.layout', compact('config','auth','products'));
    }

    public function list_types() {
        $config = 'dashboard.products.types';
        $auth = auth()->user();
        $types = ProductType::orderBy('id','DESC')->paginate(10);
        return view('dashboard.layout', compact('config','auth','types'));
    }

    public function product_details ($id) {
        $config = 'dashboard.products.product-details';
        $auth = auth()->user();
        $details = Product::where('id', $id)->first();
        return view('dashboard.layout', compact('config','auth','details'));
    }

    public function edit_product($id) {
        $config = 'dashboard.products.edit-product';
        $auth = auth()->user();
        $types = ProductType::orderBy('id','ASC')->get();
        $details = Product::where('id', $id)->first();
        return view('dashboard.layout', compact('config','auth','details','types'));
    }

    public function post_edit_product($id, Request $request) {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required',
            'type_id' => 'required|numeric',
            'info' => 'required|string',
            'describe' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);
        $product = Product::where('id', $id)->first();
        if($product) {
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->type_id = $request->type_id;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->quantity = $request->quantity;
            $product->info = $request->info;
            $product->describe = $request->describe;
            $check = $product->save();
            if($check) {
                return redirect()->back()->with('success','Cập nhật sản phẩm thành công');
            }
            return redirect()->back()->with('error','Cập nhật sản phẩm thất bại');

        }
        return redirect()->back()->with('error','Không tìm thấy sản phẩm');
    }

    public function edit_product_type($id) {
        $config = 'dashboard.products.edit-type';
        $auth = auth()->user();
        return view('dashboard.layout', compact('config','auth'));
    }

    public function post_edit_product_type($id) {

    }
}
