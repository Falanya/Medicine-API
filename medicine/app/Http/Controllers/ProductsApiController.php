<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsApiController extends Controller
{
    public function product(Product $product) {
        $products = Product::orderBy('id', 'DESC')->where('status',1)->get();

        foreach ($products as $product) {
            $product->price = number_format($product->price, 0, ',', '.');
        }

        return response()->json([
            'data' => $products,
            'status_code' => 200,
            'message' => 'ok'
        ]);
    }

    public function addProduct(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'type_id' => 'required',
            'describe' => 'required',
            'info' => 'required',
            'price' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
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

        $data_check = $request->only('name','type_id','describe','info','price','status');
        $data_check['img'] = $img_name;

        if ($data=Product::create($data_check)) {
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

    public function delete_product($id) {
        // $prod = Product::find($id);
        // if($prod->delete()){
        //     return response()->json([
        //         'data' => $prod,
        //         'status_code' => 200,
        //         'message'=> 'Xóa thành công'
        //     ]);
        // }
        // return response()->json([
        //     'data' => null,
        //     'status_code' => 404,
        //     'message'=> 'Xóa không thành công'
        // ]);
    }

    public function prods_by_type($id) {

        $productType = ProductType::find($id);
        if($products = $productType->prods) {

            foreach ($products as $product) {
                $product->price = number_format($product->price, 0, ',', '.');
            }

            return response()->json([
                'data'=> $products,
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

    public function productType(ProductType $productType) {
        $proTypes = ProductType::orderBy('name','ASC')->where('object_status',1)->get();

        return response()->json([
            'data' => $proTypes,
            'status_code' => 200,
            'message' => 'ok'
        ]);
    }

    public function addProductType(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->all(),
                'status_code' => 422,
                'message' => 'Không thể thêm loại sản phẩm'
            ]);
        }

        $data_check = $request->only('name');
        
        if($data=ProductType::create($data_check)) {
            return response()->json([
                'data' => $data,
                'status_code' => 200,
                'message' => 'Thêm loại sản phẩm thành công'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Không thể thêm sản phẩm'
        ]);
    }

    public function delete_prodType($id) {
        $proType = ProductType::find($id);

        if(!$proType) {
            return response()->json([
                'data' => null,
                'status_code' => 404,
                'message' => 'Không tìm thấy loại sản phẩm'
            ]);
        }

        $data = $proType->prods->count();

        if($data == 0 && $proType->delete()) {
            return response()->json([
                'data' => $proType,
                'status_code' => 200,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'data' => 'Không thể xóa vì loại này đang có ' . $data . ' sản phẩm',
            'status_code' => 404,
            'message'=> 'Xóa không thành công'
        ]);
    }
}
