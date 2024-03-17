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
                    'id' => $item->id,
                    'img' => $item->product->img,
                    'name' => $item->product->name,
                    'price' => number_format($price),
                    'quantity' => $item->quantity,
                    'status' => $item->status == 1 ? 'Show' : 'Hidden',
                    'status_in_stock' => $item->product->quantity == 0 ? 'Sold Out' : 'In stock',
                    'message_quantity' => $item->product->quantity < $item->quantity ? 'Only has'. $item->product->quantity .'left in stock' : '',
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
            'status' => 1,
        ])->first();
        if($cartExist) {
            if($product->quantity > 0 && $product->status == 1) {
                Cart::where([
                    'user_id' => $auth->id,
                    'product_id' => $product->id,
                    'status' => 1,
                ])->increment('quantity', $quantity);
                return response()->json([
                    'data' => Cart::where(['user_id' => $auth->id, 'product_id' => $product->id])->first(),
                    'status_code' => 200,
                    'message' => 'Add product to cart successfully'
                ]);
            }
            return response()->json([
                'status_code' => 404,
                'message' => "Product is sold out"
            ]);
        }
        $data = [
            'user_id' => $auth->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ];

        if($product->quantity > 0 && $product->status == 1) {
            Cart::create($data);
            return response()->json([
                'data' => Cart::where(['user_id' => $auth->id, 'product_id' => $product->id])->first(),
                'status_code' => 200,
                'message' => 'Your cart created successfully'
            ]);
        }
        return response()->json([
            'message' => "Product is sold out",
            'status_code' => 404
        ]);
    }

    public function edit_quantity($id ,Request $request) {
        $auth = auth()->user();
        $cart = Cart::where([
            'id' => $id,
            'status' => 1,
        ])->first();
        if (!$cart || $cart->user_id != $auth->id) {
            return response()->json([
                'message' => 'Cannot find product in your cart',
                'status_code' => 404,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'quantity' => ['required','numeric', function($attr,$value,$fail) use($cart) {
                if($value < 1) {
                    $fail('Quantity must be greater than 0');
                }
                $product = Product::find($cart->product_id);
                if (!$product) {
                    $fail('Product not found');
                } elseif ($product->status == 0) {
                    $fail('Product is not available');
                } elseif ($product->quantity < $value) {
                    $fail('This product only has ' . $product->quantity . ' left in stock');
                }
            }],
        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'status_code' => 400,
            ]);
        }
        $quantity = $request->quantity ? floor($request->quantity) : 1;
        $cart->quantity = $quantity;
        $check = $cart->save();
        if($check) {
            return response()->json([
                'message' => 'Success',
                'status_code' => 200,
            ]);
        }
        return response()->json([
            'message' => 'Something errors, please check again',
            'status_code' => 402,
        ]);
        
    }

    public function delete_cart($cart) {
        $auth = auth()->user();
        $cartExist = Cart::where([
            'id' => $cart,
            'status' => 1,
        ])->first();

        if(!$cartExist) {
            return response()->json([
                'data' => $cartExist,
                'status_code' => 404,
                'message' => 'Unable to find product from your cart, please check again'
            ]);
        }

        if($cartExist && $cartExist->user_id == $auth->id) {
            $cartExist->status = 0;
            $check = $cartExist->save();
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
        return response()->json([
            'message' => 'Cannot find product from cart',
            'status_code' => 401,
        ]);
    }

    public function clear_cart() {
        $auth = auth()->user();
        $cartUser = Cart::where([
            'user_id' => $auth->id,
            'status' => 1,
        ])->get();
        
        foreach($cartUser as $key => $item) {
            $item->status = 0;
            $item->save();
        }
        return response()->json([
            'message' => 'All products has been successfully removed from your cart',
            'status_code' => 200
        ]);
    }

    public function save_quantities(Request $request) {
        if ($request->has('quantities')) {
            $quantities = $request->input('quantities');

            foreach ($quantities as $cartId => $quantity) {
                Cart::where('id', $cartId)->update(['quantity' => $quantity]);
            }

            return response()->json(['message' => 'Quantities updated successfully'], 200);
        }

        return response()->json(['message' => 'Quantities data not found'], 400);
    }
}