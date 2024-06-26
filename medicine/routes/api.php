<?php

use App\Http\Controllers\AddressApiController;
use App\Http\Controllers\Admin\OrdersApiController;
use App\Http\Controllers\Admin\PromotionsApiController;
use App\Http\Controllers\Admin\UsersAminApiController;
use App\Http\Controllers\CartsApiController;
use App\Http\Controllers\FavoritesController;
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
        Route::get('profile-for-app', [UsersApiController::class, 'profile_for_app']);
        Route::put('change-profile', [UsersApiController::class, 'change_profile']);
        Route::post('change-password', [UsersApiController::class, 'change_password']);

        Route::get('address', [AddressApiController::class, 'show']);
        Route::get('address-for-app', [AddressApiController::class, 'show_for_app']);
        Route::post('add-address', [AddressApiController::class, 'add_address']);
        Route::put('edit-address/{address}', [AddressApiController::class, 'edit_address']);
        Route::post('delete-address/{address}', [AddressApiController::class, 'delete_address']);
        Route::post('delete-all-address', [AddressApiController::class, 'delete_all_address']);

        Route::get('promotions', [PromotionApiController::class, 'show_user']);
        Route::get('promotions-for-app', [PromotionApiController::class, 'show_user_for_app']);
        Route::get('promotion/{code}', [PromotionApiController::class,'promotion_details']);

        Route::get('create-or-delete-favorite/{product}', [FavoritesController::class, 'create_or_delete']);
        Route::get('show-favorite', [FavoritesController::class, 'show']);
    });
});

Route::group(['prefix'=> 'carts', 'middleware'=> 'auth:sanctum'], function () {
    Route::get('/cart', [CartsApiController::class, 'show']);
    Route::get('/cart-for-app', [CartsApiController::class, 'show_for_app']);
    Route::get('/add/{product}', [CartsApiController::class, 'add_cart']);
    Route::post('/edit-quantity/{id}', [CartsApiController::class, 'edit_quantity']);
    Route::get('/delete/{cart}', [CartsApiController::class, 'delete_cart']);
    Route::get('/clear', [CartsApiController::class,'clear_cart']);
    Route::post('/save-quantities', [CartsApiController::class, 'save_quantities']);
});

Route::group(['prefix' => 'orders', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/checkout', [OrderApiController::class, 'show_checkout']);
    Route::get('/checkout-for-app', [OrderApiController::class,'show_checkout_for_app']);
    Route::post('/post-checkout', [OrderApiController::class, 'post_checkout']);
    Route::get('/history', [OrderApiController::class, 'history']);
    Route::get('/history-for-app', [OrderApiController::class, 'history_for_app']);
    Route::get('/detail/{id}', [OrderApiController::class, 'detail']);
    Route::post('/apply-promotion', [OrderApiController::class, 'apply-promotion']);
    Route::get('/cancel/{id}', [OrderApiController::class, 'cancel']);
});

Route::group(['prefix'=> 'products'], function () {
    Route::get('/show', [ProductsApiController::class, 'product']);
    Route::get('/show-for-app',[ProductsApiController::class, 'product_for_app']);
    Route::get('/search', [ProductsApiController::class, 'search']);
    Route::get('/details/{slug}', [ProductsApiController::class, 'details']);
    Route::get('/products-by-type/{slug}', [ProductsApiController::class, 'prods_by_type']);
    Route::get('/products-by-type-for-app/{slug}', [ProductsApiController::class, 'prods_by_type_for_app']);
    Route::get('/top-view', [ProductsApiController::class, 'top_view']);
    Route::get('/up-view/{product}', [ProductsApiController::class, 'up_view']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('/add-product', [ProductsApiController::class, 'addProduct']);
        Route::post('/show-hidden-product/{product}', [ProductsApiController::class, 'show_hidden_product']);
        Route::post('/edit-product/{product}', [ProductsApiController::class, 'edit_product']);
        Route::post('/comment/{product}', [ProductsApiController::class, 'post_comment']);
    });
});

Route::group(['prefix'=> 'product-types'], function () {
    Route::get('show', [ProductTypesApiController::class, 'show']);
    Route::get('show-for-app', [ProductTypesApiController::class, 'show_for_app']);
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::post('add-product-type', [ProductTypesApiController::class, 'addProductType']);
        Route::post('edit-product-type/{productType}', [ProductTypesApiController::class, 'edit_product_type']);
        Route::post('delete-product-type/{productType}', [ProductTypesApiController::class, 'delete_prodType']);
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'orders'], function() {
        Route::get('show', [OrdersApiController::class, 'show']);
        Route::get('details/{order}', [OrdersApiController::class, 'details']);
        Route::get('update-status/{order}', [OrdersApiController::class, 'update_status']);
    });

    Route::group(['prefix' => 'promotions'], function() {
        Route::get('show', [PromotionsApiController::class, 'show']);
        Route::post('create', [PromotionsApiController::class, 'create']);
        Route::get('details/{promotion}', [PromotionsApiController::class, 'details']);
        Route::post('edit/{promotion}', [PromotionsApiController::class, 'edit']);
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('show', [UsersAminApiController::class, 'show']);
        Route::post('search', [UsersAminApiController::class, 'search']);
        Route::post('change-status/{id}', [UsersAminApiController::class, 'change_status']);
        Route::post('delete/{id}', [UsersAminApiController::class, 'delete']);
    });
});
