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
        $data = Promotion::where('status', 1)->orderBy('id','DESC')->get();
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
        $promotion = Promotion::where('status', 1)->orderBy('id','DESC')->get();
        $promotions = PromotionResource::collection($promotion);
        return $promotions;
    }
}