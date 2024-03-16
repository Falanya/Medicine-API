<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PromotionsApiController extends Controller
{
    public function show() {
        $auth = auth()->user();
        if($auth->role_id == 2) {
            $data = Promotion::orderBy('id','DESC')->where('status', 1)->get();
            $promotions = [];
            $status_content = [
                1 => 'Show',
                0 => 'Hidden',
            ];

            foreach($data as $key => $item) {
                $promotion = [
                    'id' => $item->id,
                    'code' => $item->code,
                    'max_users' => $item->max_users,
                    'description' => $item->description,
                    'discount_amount' => number_format($item->discount_amount),
                    'min_amount' => number_format($item->min_amount),
                    'type' => $item->type,
                    'status' => $item->status,
                    'status_content' => $status_content[$item->status] ?? 'unknown',
                    'starts_at' => $item->starts_at,
                    'expires_at' => $item->expires_at,
                ];
                $promotions[] = $promotion;
            }
            return response()->json([
                'data' => $promotions,
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
                'description' => 'nullable|string',
                'discount_amount' => 'required|numeric',
                'min_amount' => 'nullable|numeric',
                'type' => 'required|string',
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
            if($startsAt->lt($now)) {
                return response()->json([
                    'message' => 'Start date can not be less than current date time',
                    'status_code' => 401,
                ]);
            }
            if($startsAt->gt($expiresAt)) {
                return response()->json([
                    'message' => 'Expiry date must be greater than start date',
                    'status_code' => 401,
                ]);
            }
    
            $data = $request->only('code','name','max_users','description','discount_amount','min_amount','type','status');
            $data['starts_at'] = $startsAt;
            $data['expires_at'] = $expiresAt;
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

    public function edit(Promotion $promotion, Request $request) {
        $auth = auth()->user();
        if($auth->role_id == 2) {
            $validator = Validator::make($request->all(), [
                'code' => 'required|unique:promotions,code,' . $promotion->id,
                'name' => 'nullable|string',
                'max_users' => 'nullable|numeric',
                'description' => 'nullable|string',
                'discount_amount' => 'required|numeric',
                'min_amount' => 'nullable|numeric',
                'type' => 'required|string',
                'starts_at' => 'required',
                'expires_at' => 'required',
                'status' => 'required|numeric',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'message' => 401,
                ]);
            }
    
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $startsAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
            $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
    
            if($startsAt->lt($now)) {
                return response()->json([
                    'message' => 'Start date can not be less than current data time',
                    'status_code' => 401,
                ]);
            }
    
            if($expiresAt->lt($startsAt)) {
                return response()->json([
                    'message' => 'Expery date must be greater than start date',
                    'status_code' => 401,
                ]);
            }

            $data = $request->only('code','name','max_users','description','discount_amount','min_amount','type','status');
            $data['starts_at'] = $startsAt;
            $data['expires_at']= $expiresAt;
            $check = $promotion->update($data);
            if($check) {
                return response()->json([
                    'message' => 'Voucher edited successfully',
                    'status_code' => 200,
                ]);
            }
            return response()->json([
                'message' => 'Something errors, please try again',
                'status_code' => 401,
            ]);
        } else {
            return response()->json([
                'message' => 'Cannot verify role user',
                'status_code' => 401,
            ]);
        }
    }

    public function details(Promotion $promotion) {
        $auth = auth()->user();
        if ($auth->role_id == 2) {
            $discount_amount = 0;
            if($promotion->type == "percent") {
                $discount_amount = $promotion->discount_amount.'%';
            } elseif ($promotion->type == "fixed") {
                $discount_amount = number_format($promotion->discount_amount);
            } else {
                $discount_amount = 0;
            }
            $details = [
                'id' => $promotion->id,
                'name' => $promotion->name,
                'code' => $promotion->code,
                'max_users' => $promotion->max_users,
                'description' => $promotion->description,
                'discount_amount' => $discount_amount,
                'min_amount' => number_format($promotion->min_amount),
                'type' => $promotion->type,
                'starts_at' => $promotion->starts_at,
                'expires_at' => $promotion->expires_at,
            ];
            return response()->json([
                'data' => $details,
                'status_code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Cannot verify role user',
                'status_code' => 401,
            ]);
        }
    }
}