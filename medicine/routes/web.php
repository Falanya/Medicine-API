<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created';
})->name('admin.storage-link');

Route::get('/seed-db', function() {
    Artisan::call('db:seed');
    return 'Seeding completed';
})->name('admin.seed-db');

Route::get('/apis', [AdminController::class, 'show_api'])->name('admin.apis');
Route::get('/setting', [AdminController::class, 'setting'])->name('admin.setting');

Route::group(['prefix' => ''], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('product/{product}', [HomeController::class, 'product'])->name('home.product');
    Route::get('productType/{productType}', [HomeController::class, 'productType'])->name('home.productType');
    Route::get('about', [HomeController::class, 'about'])->name('home.about');
    Route::post('comment/{product}', [HomeController::class, 'post_comment'])->name('home.post_comment');
});

Route::group(['prefix'=> 'account'], function() {
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/login', [AccountController::class, 'check_login']);

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register', [AccountController::class, 'check_register']);
    Route::get('/verify-account/{email}', [AccountController::class,'verify_account'])->name('account.verify_account');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class,'check_profile']);

        Route::get('/change-password', [AccountController::class, 'change_password'])->name('account.change_password');
        Route::post('/change-password', [AccountController::class, 'check_change_password']);

        Route::get('/address', [AddressController::class,'index'])->name('account.address');
        Route::get('/add-address', [AddressController::class,'add_address'])->name('account.add_address');
        Route::post('/add-address', [AddressController::class, 'check_add_address']);
        Route::get('/edit-address/{address}', [AddressController::class, 'edit_address'])->name('account.edit_address');
        Route::post('/edit-address/{address}', [AddressController::class, 'check_edit_address'])->name('account.check_edit_address');
        Route::delete('/delete-address/{address}', [AddressController::class, 'delete_address'])->name('account.delete_address');
        Route::delete('/delete-all-address', [AddressController::class, 'delete_all_address'])->name('account.delete_all_address');
    });

    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('/forgot-password', [AccountController::class, 'check_forgot_password']);

    Route::get('/reset-password', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('/reset-password', [AccountController::class, 'check_reset_password']);

    Route::get('/logout', [AccountController::class, 'check_logout'])->name('account.logout');
});

Route::group(['prefix' => 'cart', 'middleware' => 'auth'], function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('add/{product}', [CartController::class,'add_cart'])->name('cart.add');
    Route::get('plus-1/{product}', [CartController::class, 'plus_1_product'])->name('cart.plus');
    Route::get('minus-1/{product}', [CartController::class, 'minus_1_product'])->name('cart.minus');
    Route::delete('/delete/{product}', [CartController::class,'delete_cart'])->name('cart.delete');
    Route::delete('/clear', [CartController::class,'clear_cart'])->name('cart.clear');

});

Route::group(['prefix' => 'order', 'middleware' => 'auth'], function() {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'post_checkout']);
    Route::get('/verify/{token}', [OrderController::class, 'verify'])->name('order.verify');
    Route::get('/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');
    Route::post('apply-promotion', [OrderController::class, 'apply_promotion'])->name('order.apply_promotion');

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/order', [AdminController::class, 'order_index'])->name('admin.order_index');
    Route::get('/order-detail/{order}', [AdminController::class, 'order_detail'])->name('admin.order_detail');
    Route::get('/order-update-status/{order}', [AdminController::class, 'order_update_status'])->name('admin.order_update');

    Route::resources([
        'product' => ProductController::class,
        'productType' => ProductTypeController::class
    ]);
});
