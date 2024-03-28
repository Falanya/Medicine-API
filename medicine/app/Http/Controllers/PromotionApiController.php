<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class PromotionApiController extends Controller
{
    public function show_user() {
        $data = Promotion::where('status', 'show')->orderBy('id','DESC')->get();
        if($data->count() > 0) {
            $promotions = [];
            $discount_amount = 0;
            foreach($data as $key => $item) {
                if ($item->type == "percent") {
                    $discount_amount = $item->discount_amount.'%';
                } else {
                    $discount_amount = number_format($item->discount_amount);
                }
                $promotion = [
                    'STT' => $key + 1,
                    'id' => $item->id,
                    'code' => $item->code,
                    'name' => $item->name,
                    'quantity' => $item->max_users,
                    'description' => $item->description,
                    'discount_amount' => $discount_amount,
                    'min_amount' => number_format($item->min_amount),
                    'starts_at' => $item->starts_at,
                    'expires_at' => $item->expires_at,
                ];
                $promotions[] = $promotion;
            }

            return response()->json([
                'data' => $promotions,
                'message' => 'Success',
                'status_code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'You has not any voucher!!!',
                'status_code' => 401,
            ]);
        }
    }

    public function show_user_for_app() {
        $promotion = Promotion::where('status', 'show')->orderBy('id','DESC')->get();
        $promotions = PromotionResource::collection($promotion);
        return $promotions;
    }

    public function promotion_details($code) {
        if (empty($code)) {
            return response()->json([
                'message' => 'Mã giảm giá không được rỗng',
                'status_code' => 400,
            ]);
        }

        $promotion = Promotion::where('code', $code)->first();
        if (!$promotion) {
            return response()->json([
                'message' => 'Không tìm thấy mã giảm giá',
                'status_code' => 404,
            ]);
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $startsAt = Carbon::parse($promotion->starts_at);
        $expiresAt = Carbon::parse($promotion->expires_at);

        if ($now->lt($startsAt)) {
            $error = 'Chỉ được sử dụng từ ngày ' . $promotion->starts_at;
        } elseif ($now->gt($expiresAt)) {
            $error = 'Voucher đã hết hạn';
        } else {
            $error = '';
        }

        $details = new PromotionResource($promotion);

        return response()->json([
            'data' => $details,
            'message' => $error,
            'status_code' => empty($error) ? 200 : 403,
        ]);
    }
}
