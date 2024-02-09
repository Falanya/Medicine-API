<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddressApiController extends Controller
{
    public function address() {
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

    public function add_address(Request $request) {
        $auth = auth()->user();

        $validator = Validator::make($request->all(), [
            'receiver_name' => 'required|string|min:6',
            'address' => 'required|string',
            'phone' => ['required','numeric', function($attr,$value,$fail) {
                $check_phone = is_numeric($value) && strlen((string)$value) >= 9;
                if(!$check_phone) {
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

        // return response()->json([
        //     'data' => $address
        // ]);
    }
}
