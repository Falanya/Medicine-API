<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CartsApiController extends Controller
{
    public function show() {
        $auth = auth()->user();
        if ($auth) {
            $cart = $auth->carts;
            $products = [];
            $total = 0;
            foreach($cart as $key => $item) {
                $price = $item->product->discount > 0 && $item->product->discount < $item->product->price ? $item->product->discount : $item->product->price;
                $product = [
                    'STT' => $key + 1,
                    'img' => $item->product->img,
                    'name' => $item->product->name,
                    'price' => number_format($price),
                    'quantity' => $item->quantity,
                ];
                $products[] = $product;
                $total += $price*$item->quantity;
            }
            return response()->json([
                'data' => $products,
                'total' => number_format($total),
                'status_code' => 200,
                'message' => 'Success'
            ]);
        } else {
            return response()->json([
                'message' => 'User not login',
                'status_code' => 401,
            ]);
        }
    }

    public function show_for_app() {
        $auth = auth()->user();
        if($auth) {
            $cart = $auth->carts;
            $carts = CartResource::collection($cart);
            return ['data' => $carts, 'totalPrice' => $auth->totalPriceCart];
        }
    }

    public function add_cart(Product $product, Request $request) {
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $auth = auth()->user();
        $cartExist = Cart::where([
            'user_id' => $auth->id,
            'product_id' => $product->id,
        ])->first();
        if($cartExist) {
            $check = Cart::where([
                'user_id' => $auth->id,
                'product_id' => $product->id 
            ])->increment('quantity', $quantity);
            if ($check) {
                return response()->json([
                    'data' => Cart::where(['user_id' => $auth->id, 'product_id' => $product->id])->first(),
                    'status_code' => 200,
                    'message' => 'Add product to cart successfully'
                ]);
            }
            return response()->json([
                'status_code' => 404,
                'message' => "Can't add product to cart, please check again"
            ]);
        }
        $data = [
            'user_id' => $auth->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ];

        $creCart = Cart::create($data);
        if($creCart) {
            return response()->json([
                'data' => Cart::where(['user_id' => $auth->id, 'product_id' => $product->id])->first(),
                'status_code' => 200,
                'message' => 'Your cart created successfully'
            ]);
        }
        return response()->json([
            'message' => "Can't cart, please check again",
            'status_code' => 404
        ]);
    }

    public function edit_quantity(Product $product ,Request $request) {
        $auth = auth()->user();
        $validator = Validator::make($request->all(), [
            'quantity' => ['required','numeric', function($attr,$value,$fail) {
                if($value < 1) {
                    $fail('Quantity must greater than 1');
                }
            }],
        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 401,
            ]);
        }
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $cart = Cart::where([
            'user_id' => $auth->id,
            'product_id' => $product->id,
        ])->first();
        if($cart) {
            $check = Cart::where([
                'user_id' => $auth->id,
                'product_id' => $product->id,
            ])->update([
                'quantity' => $quantity,
            ]);
            if($check) {
                return response()->json([
                    'message' => 'Success',
                    'status_code' => 200,
                ]);
            }
            return response()->json([
                'message' => 'Something errors, please check again',
                'status_code' => 401,
            ]);
        } else {
            return response()->json([
                'message' => 'Cannot find product from you cart',
                'status_code' => 401,
            ]);
        }
        
    }

    public function delete_cart(Product $product) {
        $auth = auth()->user();
        $cartExist = Cart::where([
            'user_id' => $auth->id,
            'product_id' => $product->id
        ])->first();

        if(!$cartExist) {
            return response()->json([
                'data' => $cartExist,
                'status_code' => 404,
                'message' => 'Unable to find product from your cart, please check again'
            ]);
        }

        $cartUser = Cart::where([
            'user_id' => $auth->id,
            'product_id' => $product->id
        ]);
        $check = $cartUser->delete();
        if ($check) {
            return response()->json([
                'message' => 'This product was successfully removed from your cart',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'Something errors, please check again',
            'status_code' => 404
        ]);

    }

    public function clear_cart() {
        $auth = auth()->user();
        $cartUser = Cart::where('user_id', $auth->id);
        $check = $cartUser->delete();
        if ($check) {
            return response()->json([
                'message' => 'All products has been successfully removed from your cart',
                'status_code' => 200
            ]);
        }
        return response()->json([
            'message' => 'Something errors, please try again',
            'status_code' => 404
        ]);
    }
}
