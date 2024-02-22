<?php

namespace App\Http\Controllers;

use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsApiController extends Controller
{
    public function product(Product $product, Request $request) {
        $products = Product::orderBy('id', 'DESC')->where('status',1)->get();
        if($key = $request->search) {
            $products = Product::orderBy('id', 'DESC')->where('name','like','%'.$key.'%')->where('status',1)->get();
        }
        $products_list = [];
        $statusProduct = [
            0 => 'Sold out',
            1 => 'In stock'
        ];

        foreach ($products as $item) {
            $product = [
                'id' => $item->id,
                'name' => $item->name,
                'type_id' => $item->type_id,
                'describe' => $item->describe,
                'info' => $item->info,
                'price' => number_format($item->price),
                'img' => $item->img,
                'status' => $statusProduct[$item->status] ?? '',
            ];
            $products_list[] = $product;
        }

        return response()->json([
            'data' => $products_list,
            'status_code' => 200,
            'message' => 'ok'
        ]);
    }

    public function addProduct(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'type_id' => 'required|numeric',
            'describe' => 'required',
            'info' => 'required',
            'price' => 'required|numeric',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'imgs' => 'required|array',
            'imgs.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->all(),
                'status_code' => 422,
                'message' => 'Không thể thêm sản phẩm'
            ]);
        }

        if(!$request->hasFile('img')) {
            return response()->json([
                'data' => null,
                'status_code' => 422,
                'message' => 'Hình ảnh không tồn tại'
            ]);
        }

        if(!$request->hasFile('imgs')) {
            return response()->json([
                'data' => null,
                'status_code' => 422,
                'message' => 'Các hình ảnh mô tả không tồn tại'
            ]);
        }

        $img_name = Str::random(32).".".$request->img->getClientOriginalExtension();
        $request->img->storeAs('images/products', $img_name, 'public');

        $data_check = $request->only('name','type_id','describe','info','price','status');
        $data_check['slug'] = Str::slug(request('name', '-'));
        $data_check['img'] = $img_name;
        $data = Product::create($data_check);

        if ($data && $request->hasFile('imgs')) {
            foreach($request->imgs as $key => $item) {
                $img_names = Str::random(32).".".$item->getClientOriginalExtension();
                $item->storeAs('public/images/products', $img_names);
                ImgProduct::create([
                    'product_id' => $data->id,
                    'img' => $img_names,
                ]);
            }
            return response()->json([
                'data' => $data,
                'status_code' => 200,
                'message' => 'Thêm sản phẩm thành công'
            ]);
        }

        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Không thể thêm sản phẩm'
        ]);
    }

    public function show_hidden_product(Product $product, Request $request) {
        // if($product->status == 0) {
        //     return response()->json([
        //         'message' => 'This product has been hidden before',
        //         'status_code' => 401,
        //     ]);
        // } else{
        //     $product->status = 0;
        //     $check = $product->save();
        //     if($check) {
        //         return response()->json([
        //             'message' => 'This product has been successfully hidden',
        //             'status_code' => 200
        //         ]);
        //     }
        // }
        
        // return response()->json([
        //     'message' => 'Something errors, please try again',
        //     'status_code' => 404
        // ]);

        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
                'message' => 'Something errors, please check again',
                'status_code' => 401
            ]);
        }
        $data = $request->only('status');
        $check = $product->update($data);
        $statusProduct = [
            0 => 'Hidde',
            1 => 'Present',
        ];
        if($check) {
            $data_product = Product::find($product)->first();
            return response()->json([
                'message' => 'Changed the product status to '. $statusProduct[$data_product->status],
                'status_code' => 200,
            ]);
        }
        
        return response()->json([
            'message' => 'Something errors, please check again',
            'status_code' => 404,
        ]);
    }

    public function prods_by_type(ProductType $productType) {

        $nameType = ProductType::find($productType)->first();
        $data = $productType->products;
        $products = [];
        $statusProduct = [
            0 => 'Sold out',
            1 => 'In stock'
        ];
        if($data) {
            foreach($data as $item) {
                $product = [
                    'id' => $item->id,
                    'type_id' => $item->type_id,
                    'name' => $item->name,
                    'img' => $item->img,
                    'price' => number_format($item->price),
                    'status' => $statusProduct[$item->status] ?? '',
                ];
                $products[] = $product;
            }
            return response()->json([
                'type' => $nameType,
                'products'=> $products,
                'status_code' => 200,
                'message'=> 'ok'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message'=> 'Not ok'
        ]);
    }

    public function edit_product(Product $product, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,'.$product->id,
            'type_id' => 'required|numeric',
            'describe' => 'required',
            'info' => 'required',
            'price' => 'required|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'imgs' => 'nullable|array',
            'imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
                'message' => 'Something errors, please check again',
                'status_code' => 401
            ]);
        }

        $data = $request->only('name','type_id','describe','info','price','status');
        $data['slug'] = Str::slug($request->name, '-');

        if($request->hasFile('img')) {
            Storage::disk('public')->delete('images/products/'.$product->img);
            $img_name = Str::random(32).".".$request->img->getClientOriginalExtension();
            $request->img->storeAs('images/products', $img_name, 'public');
            $data['img'] = $img_name;
        }
        
        $check = $product->update($data);
        if ($check) {
            if($request->hasFile('imgs')) {
                foreach($product->img_details as $key => $item) {
                    Storage::disk('public')->delete('images/products/'.$item->img);
                }
                $product->img_details()->delete();
                foreach($request->imgs as $key => $item) {
                    $img_names = Str::random(32).".".$item->getClientOriginalExtension();
                    $item->storeAs('images/products', $img_names, 'public');
                    ImgProduct::create([
                        'img' => $img_names,
                        'product_id' => $product->id,
                    ]);
                }
            }
            
            $product_data = $product->fresh();
            return response()->json([
                'data' => $product_data,
                'message' => 'Success',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Something errors, please check again',
                'status_code' => 401
            ]);
        }
    }

    public function details($slug) {
        $product = Product::where('slug', $slug)->first();
        $img_details = $product->img_details()->get();
        return response()->json([
            'data' => $product,
            'img_details' => $img_details,
            'status_code' => 200,
        ]);
    }

}
