<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request) {
        $config = 'dashboard.promotions.index';
        $auth = auth()->user();
        $promotions = Promotion::orderBy('id','desc')
            ->when($request->code != null, function($q) use($request) {
                return $q->where('code', $request->code);
            })
            ->when($request->name != null, function($q) use($request) {
                return $q->where('name', $request->name);
            })
            ->when($request->type != null, function($q) use($request) {
                $type = $request->type;
                if($type == 'fixed') {
                    return $q->where('type', 'fixed');
                } elseif($type == 'percent') {
                    return $q->where('type', 'percent');
                }
            })
            ->when($request->starts_at != null, function($q) use($request) {
                return $q->whereDate('starts_at', $request->starts_at);
            })
            ->when($request->expires_at != null , function ($q) use($request) {
                return $q->whereDate('expires_at', $request->expires_at);
            })
            ->when($request->status != null, function($q) use($request) {
                $status = $request->status;
                if($status == 'hidden') {
                    return $q->where('status', 'hidden');
                } elseif($status == 'show') {
                    return $q->where('status', 'show');
                } elseif($status == 'expired') {
                    return $q->where('status', 'expired');
                }
            })
            ->when($request->discount_amount != null, function ($q) use($request) {
                $discount_amount = $request->discount_amount;
                if($discount_amount == '0_100000') {
                    return $q->whereBetween('discount_amount', [0,100000]);
                } elseif($discount_amount == '100000_500000') {
                    return $q->whereBetween('discount_amount', [100000,500000]);
                } elseif($discount_amount == '500000_1000000') {
                    return $q->whereBetween('discount_amount', [500000,1000000]);
                }
            })
            ->when($request->min_amount != null, function ($q) use($request) {
                $min_amount = $request->min_amount;
                if($min_amount == '0_100000') {
                    return $q->whereBetween('min_amount', [0,100000]);
                } elseif($min_amount == '100000_500000') {
                    return $q->whereBetween('min_amount', [100000,500000]);
                } elseif($min_amount == '500000_1000000') {
                    return $q->whereBetween('min_amount', [500000,1000000]);
                }
            })
            ->paginate(20);
        return view('dashboard.layout', compact('config','auth','promotions'));
    }

    public function create() {

    }

    public function post_create() {

    }

    public function edit($id) {

    }

    public function post_edit($id) {

    }

}
