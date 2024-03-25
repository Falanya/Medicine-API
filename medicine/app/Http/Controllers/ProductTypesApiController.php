<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductTypeResource;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductTypesApiController extends Controller
{
    public function show() {
        $proTypes = ProductType::orderBy('name','ASC')->where('object_status',1)->get();

        return response()->json([
            'data' => $proTypes,
            'status_code' => 200,
            'message' => 'ok'
        ]);
    }

    public function show_for_app() {
        $proTypes = ProductType::orderBy('name','ASC')->where('object_status',1)->get();
        return ProductTypeResource::collection($proTypes);
    }

    public function addProductType(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'data' => $validator->errors()->all(),
                'status_code' => 422,
                'message' => 'Cannot add this category'
            ]);
        }

        $data_check = $request->only('name');
        $data_check['slug'] = Str::slug(request('name'), '-');

        if($data=ProductType::create($data_check)) {
            return response()->json([
                'data' => $data,
                'status_code' => 200,
                'message' => 'Add category successfully'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Cannot add this category'
        ]);
    }

    public function edit_product_type(ProductType $productType, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'object_status' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
                'message' => 'Something errors, please check again',
                'status_code' => 401
            ]);
        }

        $data = $request->only('name','object_status');
        $data['slug'] = Str::slug(request('name'), '-');
        $check = $productType->update($data);
        if ($check) {
            $data_type = ProductType::find($productType)->first();
            return response()->json([
                'data' => $data_type
            ]);
        }
        return response()->json([
            'message' => 'Something errors, please check again',
            'status_code' => 404
        ]);
    }

    public function delete_prodType(ProductType $productType) {
        //$proType = ProductType::find($productType)->first();

        $data = $productType->products->count();

        if($data == 0 && $productType->delete()) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Deleted successfully'
            ]);
        }
        return response()->json([
            'data' => 'Cannot delete because this category has '. $data .' products',
            'status_code' => 401,
            'message'=> 'Delete failed'
        ]);
    }
}
