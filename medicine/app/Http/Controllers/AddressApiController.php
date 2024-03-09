<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddressApiController extends Controller
{
    public function show() {
        $auth = auth()->user();
        $check_count = $auth->addresses->where('user_id', $auth->id)->where('object_status', 1)->count();
        $data = $auth->addresses->where('user_id', $auth->id)->where('object_status', 1);
        if($data) {
            return response()->json([
                'data' => $data,
                'quantity' => $check_count,
                'status_code' => 200,
                'message' => 'Success'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Not success'
        ]);

    }

    public function show_for_app() {
        $auth = auth()->user();
        $addresses = AddressResource::collection($auth->addresses)->where('object_status', 1);
        return $addresses;
    }

    public function add_address(Request $request) {
        $auth = auth()->user();

        $validator = Validator::make($request->all(), [
            'receiver_name' => 'bail|required|string|min:6',
            'address' => 'bail|required|string',
            'phone' => ['bail','required','numeric', function($attr,$value,$fail) {
                $check_num = is_numeric($value) && strlen((string)$value) >= 9;
                if(!$check_num) {
                    $fail('Your phone number must be at least 9 numbers');
                }
            }],
            'confirm_password' => ['required', function($attr,$value,$fail) use($auth) {
                if(!Hash::check($value, $auth->password)) {
                    $fail('Your password is incorrect, please try again');
                }
            }]
        ]);

        if($validator->fails()) {
            return response()->json([
                'data' => null,
                'status_code' => 404,
                'message' => $validator->errors()->all()
            ]);
        }

        $data = $request->only('receiver_name','address','phone');
        $data['user_id'] = $auth->id;

        $check_count = $auth->addresses->where('object_status', 1)->count();

        if($check_count < 5) {
            $check = Address::create($data);
            if($check) {
                return response()->json([
                    'data' => $data,
                    'status_code' => 200,
                    'message' => 'Your address created successfully'
                ]);
            }
        } else {
            return response()->json([
                'data' => $check_count,
                'message' => 'Your number of addresses is limited to a maximum of 5 addresses',
                'status_code' => 404,
            ]);
        }
        
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Something errors, please check again'
        ]);
        
    }

    public function edit_address(Address $address, Request $request) {
        $auth = auth()->user();
        $validator = Validator::make($request->all(), [
            'receiver_name' => 'bail|required|min:6',
            'address' => 'bail|required|string',
            'phone' => ['bail', 'required', 'numeric', function($attr,$value,$fail) {
                $check_num = is_numeric($value) && strlen((string)$value) >= 9;
                if(!$check_num) {
                    $fail('Your phone number must be at least 9 numbers');
                }
            }]
        ]);

        $data = $request->only('receiver_name','address','phone');

        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 404
            ]);
        }

        $addUser = Address::where([
            'id' => $address->id,
            'user_id' => $auth->id,
            'object_status' => 1
        ])->first();

        if(!$addUser) {
            return response()->json([
                'data' => null,
                'message' => 'Not find user address, please try again',
                'status_code' => 404
            ]);
        }

        $check = $addUser->update($data);

        if(!$check) {
            return response()->json([
                'data' => null,
                'status_code' => 404,
                'message' => 'Unable to update, please check again'
            ]);
        }

        return response()->json([
            'data' => $addUser,
            'status_code' => 200,
            'message' => 'Success'
        ]);
        
    }

    public function delete_address(Address $address) {
        $auth = auth()->user();
        $address = Address::where([
            'id' => $address->id,
            'user_id' => $auth->id
        ])->first();
        $address->object_status = 0;
        $check = $address->save();
        if($check) {
            return response()->json([
                'data' => $address,
                'status_code' => 200,
                'message' => 'Your address deleted successfully'
            ]);
        }
        return response()->json([
            'data' => null,
            'status_code' => 404,
            'message' => 'Something errors, please check again'
        ]);
    }

    public function delete_all_address() {
        $auth = auth()->user();
        $addresses = Address::where([
            'user_id' => $auth->id,
            'object_status' => 1
        ])->get();
        
        foreach($addresses as $address) {
            $address->object_status = 0;
            $address->save();
        }

        return response()->json([
            'message' => 'All address deleted successfully',
            'status_code' => 200
        ]);

    }
}
