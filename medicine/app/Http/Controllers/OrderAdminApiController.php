<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminApiController extends Controller
{
    public function show() {
        //Cuối đường link thêm "?status=0/1/2/3/4", đại diện cho các trạng thái đơn hàng
        $status = request('status', 1);
        $check_role = auth()->user()->role_id == 2;
        if($check_role) {
            $data = Order::orderBy('id', 'DESC')->where('status', $status)->get();
            $orders = [];
            $statusOrder = [
                0 => 'Not verified',
                1 => 'Verified',
                2 => 'Shipping',
                3 => 'Completed',
                4 => 'Cancelled'
            ];
            foreach($data as $key => $item) {
                $order = [
                    'stt' => $key + 1,
                    'id' => $item->id,
                    'order_data' => $item->created_at->format('d/m/Y'),
                    'status_content' => $statusOrder[$item->status] ?? '',
                    'status' => $item->status,
                    'totalPrice' => number_format($item->totalPrice),
                ];
                $orders[] = $order;
            }
            return response()->json([
                'data' => $orders,
                'message' => 'Check role user successfully',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'Check role user not successfully',
            'status_code' => 404,
        ],404);
    }

    public function details($order) {
        $check_role = auth()->user()->role_id == 2;
        if($check_role) {
            $data = Order::where('id', $order)->first();
            $statusOrder = [
                0 => 'Not verified',
                1 => 'Verified',
                2 => 'Shipping',
                3 => 'Completed',
                4 => 'Cancelled',
            ];
            $orders = [
                'id' => $data->id,
                'address_id' => $data->address_id,
                'user_id' => $data->user_id,
                'note' => $data->note,
                'totalPrice' => $data->totalPrice,
                'status_content' => $statusOrder[$data->status] ?? '',
                'status' => $data->status,
                'order_data' => $data->created_at->format('d/m/Y')
            ];

            $user = $data->user;
            $userInfo = [
                'fullname' => $user->fullname,
                'email' => $user->email,
            ];

            $cus = $data->address;
            $cusInfo = [
                'receiver_name' => $cus->receiver_name,
                'phone' => $cus->phone,
                'address' => $cus->address,
            ];

            $product = $data->details;
            $products = [];
            foreach($product as $key => $item) {
                $data_product = [
                    'id' => $item->id,
                    'name' => $item->product->name,
                    'img' => $item->product->img,
                    'quantity' => $item->quantity,
                    'price' => number_format($item->price),
                    'subTotal' => number_format($item->price * $item->quantity),
                ];
                $products[] = $data_product;
            }

            return response()->json([
                'data' => $orders,
                'userInfo' => $userInfo,
                'cusInfo' => $cusInfo,
                'details' => $products,
                'message' => 'Check role user successfully',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'Check role user not successfully',
            'status_code' => 404,
        ]);
    }

    public function update_status(Order $order) {
        //Thêm vào cuối link "?status=0/1/2/3/4" để đổi trạng thái
        $status = request('status', 1);
        $check_role = auth()->user()->role_id == 2;
        if($check_role) {
            $order->update([
                'status' => $status
            ]);
            return response()->json([
                'message' => "Change order's status successfully",
                'status_code' => 200,
            ]);
        }
        return response()->json([
            'message' => 'Check role user not successfully',
            'status_code' => 404,
        ]);
        
    }
}
