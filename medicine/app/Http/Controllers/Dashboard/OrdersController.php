<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show(Request $request) {
        $todayDate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $orders = Order::orderBy('id', 'DESC')
                ->when($request->tracking_number != null, function ($q) use($request) {
                    return $q->where('tracking_number', $request->tracking_number);
                })
                ->when($request->status != null, function($q) use($request) {
                    $status = $request->status;
                    if($status == 'verified') {
                        return $q->where('status',1);
                    } elseif($status == 'shipping') {
                        return $q->where('status',2);
                    } elseif($status == 'completed') {
                        return $q->where('status',3);
                    } elseif($status == 'cancel') {
                        return $q->where('status',4);
                    } elseif($status == 'not_verified') {
                        return $q->where('status',0);
                    }
                })
                ->when($request->date != null, function ($q) use ($request) {
                    return $q->whereDate('created_at', $request->date);
                })
                ->paginate(20);
            $config = 'dashboard.orders.index';
            $auth = auth()->user();
            return view('dashboard.layout', compact('orders','config','auth'));
    }

    public function details($order) {
        $auth = auth()->user();
        $config = 'dashboard.orders.details';
        if($order) {
            $details = Order::where('tracking_number', $order)->first();
            return view('dashboard.layout', compact('auth','details','config'));
        }
        return view('404');
    }

    public function change_status($order) {
        $request = request('status', 1);
        if($request) {
            $orders = Order::where('tracking_number', $order)->first();
            $orders->status = $request;
            $orders->save();
            if($request == 4) {
                foreach($orders->details as $detail) {
                    $product_id = $detail->product_id;
                    Product::find($product_id)->increment('quantity', $detail->quantity);
                }
            } elseif ($request == 3) {
                foreach($orders->details as $detail) {
                    $detail->status = 1;
                    $detail->save();
                }
            }
            return redirect()->back();
        }
        return view(404);
    }

}
