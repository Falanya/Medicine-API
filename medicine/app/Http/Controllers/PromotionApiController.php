<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PromotionApiController extends Controller
{
    public function show() {
        $auth = auth()->user();
        if($auth->role_id == 2) {
            $data = Promotion::orderBy('id','DESC')->where('status', 1)->get();
            return response()->json([
                'data' => $data,
                'message' => 'Success',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'not success',
            'status_code' => 401
        ]);
    }

    public function create(Request $request) {
        $auth = auth()->user();
        if ($auth->role_id == 2) {
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:promotions,code',
                'name' => 'nullable|string',
                'max_users' => 'nullable|numeric',
                'max_users_user' => 'nullable|numeric',
                'description' => 'nullable|string',
                'discount_amount' => 'required|numeric',
                'min_amount' => 'nullable|numeric',
                'type' => 'required',
                'status' => 'required|numeric',
                'starts_at' => 'required',
                'expires_at' => 'required',
    
            ]);
    
            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 'Not success',
                    'status_code' => 401
                ]);
            }
    
            $startsAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            if($startsAt->lte($now)) {
                return response()->json([
                    'message' => 'Start date can not be less than current date time',
                    'status_code' => 401,
                ]);
            }
            if($expiresAt->gt($startsAt)) {
                return response()->json([
                    'message' => 'Expiry date must be greater than start date',
                    'status_code' => 401,
                ]);
            }
    
            $data = $request->only('code','name','max_users','max_users_user','description','discount_amount','min_amount','type','status','starts_at','expires_at');
            $check = Promotion::create($data);
            if($check) {
                return response()->json([
                    'data' => $data,
                    'message' => 'Voucher added successfully',
                    'status_code' => 200,
                ]);
            }
            return response()->json([
                'message' => 'Something errors, please check again',
                'status_code' => 401,
            ]);
        } else {
            return response()->json([
                'message' => 'Cannot verify account user',
                'status_code' => 401,
            ]);
        }
    }

    public function edit($promotion) {

    }

    public function hidden_show($promotion) {

    }
}
