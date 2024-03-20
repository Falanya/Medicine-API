<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show() {
        $request = request('status', 1);
        if($request) {
            $orders = Order::orderBy('id', 'DESC')->where('status', $request)->paginate(20);
            $config = 'dashboard.orders.index';
            $auth = auth()->user();
            return view('dashboard.layout', compact('orders','config','auth','request'));
        }
        return view('404');
    }
}