<?php

use App\Http\Controllers\AddressApiController;
use App\Http\Controllers\CartsApiController;
use App\Http\Controllers\OrderAdminApiController;
use App\Http\Controllers\OrderApiController;
use App\Http\Controllers\ProductsApiController;
use App\Http\Controllers\ProductTypesApiController;
use App\Http\Controllers\PromotionApiController;
use App\Http\Controllers\UsersApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/order/verify/{token}', [OrderApiController::class, 'verify'])->name('orders.verify');
Route::group(['prefix'=> 'users'], function () {
    Route::post('register', [UsersApiController::class, 'check_register']);
    Route::post('login', [UsersApiController::class, 'check_login']);
    Route::get('verify-account/{email}', [UsersApiController::class, 'verify_account'])->name('users.verify-account');
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('logout', [UsersApiController::class, 'logout']);
        Route::post('delete-all-tokens', [UsersApiController::class, 'delete_all_tokens']);

        Route::get('profile', [UsersApiController::class, 'profile']);
        Route::put('change-profile', [UsersApiController::class, 'change_profile']);
        
        Route::get('address', [AddressApiController::class, 'address']);
        Route::post('add-address', [AddressApiController::class, 'add_address']);
        Route::put('edit-address/{address}', [AddressApiController::class, 'edit_address']);
        Route::post('delete-address/{address}', [AddressApiController::class, 'delete_address']);
        Route::post('delete-all-address', [AddressApiController::class, 'delete_all_address']);

        Route::get('promotions', [PromotionApiController::class, 'show_user']);
    });
});

Route::group(['prefix'=> 'carts', 'middleware'=> 'auth:sanctum'], function () {
    Route::get('/cart', [CartsApiController::class, 'show']);
    Route::get('/add/{product}', [CartsApiController::class, 'add_cart']);
    Route::get('/plus-1/{product}', [CartsApiController::class, 'plus_1_cart']);
    Route::get('/minus-1/{product}', [CartsApiController::class, 'minus_1_cart']);
    Route::get('/delete/{product}', [CartsApiController::class, 'delete_cart']);
    Route::get('/clear', [CartsApiController::class,'clear_cart']);
});

Route::group(['prefix' => 'orders', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/checkout', [OrderApiController::class, 'show_checkout']);
    Route::post('/post-checkout', [OrderApiController::class, 'post_checkout']);
    Route::get('/history', [OrderApiController::class, 'history']);
    Route::get('/detail/{order}', [OrderApiController::class, 'detail']);
    Route::post('/apply-promotion', [OrderApiController::class, 'apply-promotion']);
});

Route::group(['prefix'=> 'products'], function () {
    Route::get('/show', [ProductsApiController::class, 'product']);
    Route::get('/search', [ProductsApiController::class, 'search']);
    Route::get('/details/{slug}', [ProductsApiController::class, 'details']);
    Route::get('/products-by-type/{slug}', [ProductsApiController::class, 'prods_by_type']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/add-product', [ProductsApiController::class, 'addProduct']);
        Route::post('/show-hidden-product/{product}', [ProductsApiController::class, 'show_hidden_product']);
        Route::post('/edit-product/{product}', [ProductsApiController::class, 'edit_product']);
        Route::post('/comment/{product}', [ProductsApiController::class, 'post_comment']);
    });
});

Route::group(['prefix'=> 'product-types'], function () {
    Route::get('show', [ProductTypesApiController::class, 'show']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('add-product-type', [ProductTypesApiController::class, 'addProductType']);
        Route::post('edit-product-type/{productType}', [ProductTypesApiController::class, 'edit_product_type']);
        Route::post('delete-product-type/{productType}', [ProductTypesApiController::class, 'delete_prodType']);
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'orders'], function() {
        Route::get('show', [OrderAdminApiController::class, 'show']);
        Route::get('details/{order}', [OrderAdminApiController::class, 'details']);
        Route::get('update-status/{order}', [OrderAdminApiController::class, 'update_status']);
    });

    Route::group(['prefix' => 'promotions'], function() {
        Route::get('show', [PromotionApiController::class, 'show']);
        Route::post('create', [PromotionApiController::class, 'create']);
        Route::get('details/{promotion}', [PromotionApiController::class, 'details']);
        Route::post('edit/{promotion}', [PromotionApiController::class, 'edit']);
    });
});