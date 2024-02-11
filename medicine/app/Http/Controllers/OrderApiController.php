<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function show_checkout() {
        $auth = auth()->user();
        $check = $auth->addresses;
        $orders = [];
        foreach($check as $address) {
            $orders = array_merge($orders, $address->orders()->get()->toArray());
        }
        return response()->json([
            'data' => $orders
        ]);
    }
}
