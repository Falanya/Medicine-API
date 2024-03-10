<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('dashboard.index');
    }

    public function show_api() {
        return view('admin.apis');
    }

    public function setting() {
        return view('admin.setting');
    }

    public function order_index() {
        $status = request('status', 1);
        $orders = Order::orderBy('id','DESC')->where('status', $status)->paginate();
        return view('admin.order.index', compact('orders'));
    }

    public function order_detail(Order $order) {
        $auth = $order->user;
        return view('admin.order.detail', compact('auth', 'order'));
    }

    public function order_update_status(Order $order) {
        $status = request('status', 1);
        $order->update(['status' => $status]);
        return redirect()->route('admin.order_index');
    }

}
