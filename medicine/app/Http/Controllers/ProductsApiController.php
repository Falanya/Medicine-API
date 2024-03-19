<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductTypeResource;
use App\Models\Comment;
use App\Models\ImgProduct;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsApiController extends Controller
{
    public function product() {
        $products = Product::orderBy('id', 'DESC')->where('status', 1)->get();
        return ProductResource::collection($products);
    }

    public function product_for_app() {
        $products = Product::orderBy('id', 'DESC')->where('status', 1)->get();
        return ProductResource::collection($products);
    }

    public function search(Request $request) {
        $key = $request->search;
        if ($key) {
            $data = Product::orderBy('id', 'DESC')->where('name','like','%'.$key.'%')->where('status', 1)->get();
            return ProductResource::collection($data);
        }
        return response()->json([
            'message' => 'Something errors, please check again',
            'status_code' => 401
        ]);
    }

    public function addProduct(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'type_id' => 'required|numeric',
            'describe' => 'required',
            'info' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'imgs' => 'nullable|array',
            'imgs.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
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

        $img_name = Str::random(32).".".$request->img->getClientOriginalExtension();
        $request->img->storeAs('images/products', $img_name, 'public');

        $data_check = $request->only('name','type_id','describe','info','price','discount','status');
        $data_check['slug'] = Str::slug(request('name'), '-');
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

    public function prods_by_type($slug) {
        $type = ProductType::where('slug', $slug)->first();
        $products = $type->products()->paginate(10);
        return ['data' => $products];
    }

    public function prods_by_type_for_app($slug) {
        $type = ProductType::where('slug', $slug)->first();
        $products = $type->products()->paginate(10);
        return ['data' => $products];
    }

    public function edit_product(Product $product, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,'.$product->id,
            'type_id' => 'required|numeric',
            'describe' => 'required',
            'info' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
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

        $data = $request->only('name','type_id','describe','info','price','discount','status');
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
        $data = Product::where('slug', $slug)->first();
        $product = new ProductResource($data);
        return response()->json([
            'data' => $product,
            'status_code' => 200,
        ]);
    }

    public function post_comment(Product $product, Request $request) {
        $auth = auth()->user();
        if ($auth) {
            $validator = Validator::make($request->all(), [
                'comment' => 'required|string|min:10|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'status_code' => 401,
                ]);
            }
    
            $data = $request->only('comment');
            $data['user_id'] = $auth->id;
            $data['product_id'] = $product->id;
            $check = Comment::create($data);
            if($check) {
                return response()->json([
                    'message' => 'Comment created successfully',
                    'status_code' => 200,
                ]);
            }
            return response()->json([
                'message' => 'Something errors, please try again',
                'status_code' => 401,
            ]);
        }
        return response()->json([
            'message' => 'User not login',
            'status_code' => 401,
        ]);
    }

    public function top_view() {
        $product = Product::orderBy('view','DESC')->where('status', 1)->where('view', '>', 0)->limit(10)->get();
        $products = ProductResource::collection($product);
        return $products;
    }

    public function up_view($product) {
        $products = Product::find($product);
        if($products) {
            $products->view = $products->view + 1;
            $products->save();
            return response()->json([
                'message' => 'Success',
                'status_code' => 200,
            ]);
        }
        return response()->json([
            'message' => 'Cannot find product',
            'status_code' => 401,
        ]);
    }

}