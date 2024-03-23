<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'img' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg', function($attr,$value,$fail) use($request) {
                if($value != null) {
                    if($request->hasAny('img')) {
                        $file = $request->file('img');
                        if(!$file->isValid()) {
                            return $fail('Invalid photo');
                        }
                    } else {
                        if (!$request->exists('img')) {
                            return $fail('Image is not exist');
                        }
                    }
                }
            }],
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

            if($request->img != null) {
                $img_name = Str::random(32).".".$request->img->getClientOriginalExtension();
                $request->img->storeAs('images/products', $img_name, 'public');
                $product->img = $img_name;
            }

            $check = $product->save();
            if($check) {
                return redirect()->back()->with('success','Cập nhật sản phẩm thành công');
            }
            return redirect()->back()->with('error','Cập nhật sản phẩm thất bại');

        }
        return redirect()->back()->with('error','Không tìm thấy sản phẩm');
    }

    public function update_status_product($id) {
        $product = Product::find($id);
        if($product) {
            if($product->status == 1) {
                $product->status = 0;
            } else {
                $product->status = 1;
            }
            $product->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái sản phẩm thành công']);
        }
        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
    }

    public function edit_product_type($id) {
        $config = 'dashboard.products.edit-type';
        $auth = auth()->user();
        return view('dashboard.layout', compact('config','auth'));
    }

    public function post_edit_product_type($id) {

    }
}
