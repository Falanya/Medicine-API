<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show() {
        $request = request('status', 1);
        if($request) {
            $orders = Order::orderBy('id', 'ASC')->where('status', $request)->get();
            $config = 'dashboard.orders.index';
            $auth = auth()->user();
            return view('dashboard.layout', compact('orders','config','auth','request'));
        }
        return view('404');
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
            return redirect()->back();
        }
        return view(404);
    }

}
