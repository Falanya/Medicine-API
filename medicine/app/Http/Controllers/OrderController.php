<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductType;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout(Product $product) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        $address = Address::orderBy('id','ASC')->where('user_id',$auth->id)->get();
        $address_count = $auth->addresses->count();
        $carts = Cart::orderBy('created_at','DESC')->where('user_id', $auth->id)->get();
        return view('checkout', compact('proTypes','auth', 'address',  'address_count','carts'));
    }

    public function history() {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        $orders = $auth->orders;
        return view('account.history', compact('proTypes','auth','orders'));
    }

    public function detail(Order $order) {
        $proTypes = ProductType::orderBy('name','ASC')->get();
        $auth = auth()->user();
        return view('account.order-detail', compact('proTypes', 'auth', 'order'));
    }

    public function post_checkout(Request $request) {
        $auth = auth()->user();
        $request->validate([
            'address_id' => 'bail|required',
            'note' => 'max:255',
            'promotion_code' => ['nullable','exists:promotions,code', function($attr,$value,$fail) {
                $promotion = Promotion::where('code', $value)->first();

                if ($promotion) {
                    if ($promotion->status == 0) {
                        return $fail('Voucher is not active');
                    }
    
                    $now = Carbon::now('Asia/Ho_Chi_Minh');
                    $nowF = Carbon::createFromFormat('Y-m-d H:i:s', $now);
                    $startsAt = Carbon::createFromFormat('Y-m-d H:i:s', $promotion->starts_at);
                    $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s', $promotion->expires_at);
    
                    if ($nowF->lt($startsAt)) {
                        return $fail('Voucher can only be used from ' . $startsAt->format('d/m/Y H:i:s'));
                    }
    
                    if ($expiresAt->lt($nowF)) {
                        return $fail('Voucher has expired');
                    }
                }
            }],
        ]);

        $data = $request->only('address_id', 'note', 'promotion_code');
        $data['user_id'] = $auth->id;
        $order = Order::create($data);
        if ($order) {
            $token = Str::random(40);

            foreach($auth->carts as $cart) {
                $price = $cart->product->discount > 0 && $cart->product->discount < $cart->product->price ? $cart->product->discount : $cart->product->price;
                $data_order = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $price,
                ];
                ProductOrder::create($data_order);
            }
            $auth->carts()->delete();
            $order->token = $token;
            $order->save();
            Mail::to($auth->email)->send(new OrderMail($order, $token));

            return redirect()->route('home.index');
        }
        return redirect()->route('home.index');
    }

    public function verify($token) {
        $order = Order::where('token', $token)->firstOrFail();
        //dd($order);
        if($order) {
            $order->token = null;
            $order->status = 1;
            $order->save();
            return redirect()->route('home.index');
        }
        return redirect()->route('home.index');
    }

}
