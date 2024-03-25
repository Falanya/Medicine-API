<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\OrdersController as DashboardOrdersController;
use App\Http\Controllers\Dashboard\UsersController as DashboardUsersController;
use App\Http\Controllers\Dashboard\ProductsController as DashboardProductsController;
use App\Http\Controllers\Dashboard\PromotionController as DasboardPromotionController;
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
    Route::post('/login', [AccountController::class, 'check_login'])->name('account.post_login');

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register', [AccountController::class, 'check_register'])->name('account.post_register');
    Route::get('/verify-account/{email}', [AccountController::class,'verify_account'])->name('account.verify_account');

    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('/process-forgot-password', [AccountController::class, 'process_forgot_password'])->name('account.process_forgot_password');
    Route::get('/reset-password/{token}', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('/process-reset-password', [AccountController::class, 'process_reset_password'])->name('account.process_reset_password');

    Route::group(['middleware' => 'login'], function() {
        Route::get('/index', [AccountController::class, 'index'])->name('account.index');
        Route::get('/setting', [AccountController::class, 'setting'])->name('account.setting');
        Route::group(['prefix' => 'orders'], function() {
            Route::get('/history', [])->name('account.order.history');
        });


        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class,'check_profile'])->name('account.post-change-profile');

        Route::get('/change-password', [AccountController::class, 'change_password'])->name('account.change_password');
        Route::post('/change-password', [AccountController::class, 'check_change_password'])->name('account.post-change-password');

        Route::get('/address', [AddressController::class,'index'])->name('account.address');
        Route::get('/add-address', [AddressController::class,'add_address'])->name('account.add_address');
        Route::post('/add-address', [AddressController::class, 'check_add_address']);
        Route::get('/edit-address/{address}', [AddressController::class, 'edit_address'])->name('account.edit_address');
        Route::post('/edit-address/{address}', [AddressController::class, 'check_edit_address'])->name('account.check_edit_address');
        Route::delete('/delete-address/{address}', [AddressController::class, 'delete_address'])->name('account.delete_address');
        Route::delete('/delete-all-address', [AddressController::class, 'delete_all_address'])->name('account.delete_all_address');

        Route::get('/promotions', [AccountController::class, 'show_promotions'])->name('account.promotions');

        Route::get('/logout', [AccountController::class, 'check_logout'])->name('account.logout');
    });

});

Route::group(['prefix' => 'cart', 'middleware' => 'login'], function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('add/{product}', [CartController::class,'add_cart'])->name('cart.add');
    Route::get('update-cart/{product}', [CartController::class, 'update_cart'])->name('cart.update');
    Route::delete('/delete/{product}', [CartController::class,'delete_cart'])->name('cart.delete');
    Route::delete('/clear', [CartController::class,'clear_cart'])->name('cart.clear');
    Route::post('/save-quantities', [CartController::class, 'save_quantities'])->name('cart.save_quantities');
});

Route::get('order/verify/{token}', [OrderController::class, 'verify'])->name('order.verify');
Route::group(['prefix' => 'order', 'middleware' => 'login'], function() {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'post_checkout']);

    Route::get('/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/detail/{order}', [OrderController::class, 'detail'])->name('order.detail');
    Route::post('apply-promotion', [OrderController::class, 'apply_promotion'])->name('order.apply_promotion');

    Route::get('/index', [OrderController::class, 'index'])->name('order.index');
    Route::get('/details/{order}', [OrderController::class, 'details'])->name('order.details');

});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/order', [AdminController::class, 'order_index'])->name('admin.order_index');
    Route::get('/order-detail/{order}', [AdminController::class, 'order_detail'])->name('admin.order_detail');
    Route::get('/order-update-status/{order}', [AdminController::class, 'order_update_status'])->name('admin.order_update');

    Route::resources([
        'product' => ProductController::class,
        'productType' => ProductTypeController::class
    ]);
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function() {
    Route::get('/', [DashboardHomeController::class, 'index'])->name('dashboard.index');
    Route::group(['prefix' => 'users'], function() {
        Route::get('/index', [DashboardUsersController::class, 'index'])->name('dashboard.users.index');
        Route::get('/create', [DashboardUsersController::class, 'create'])->name('dashboard.users.create');
        Route::post('/post-create', [DashboardUsersController::class, 'post_create'])->name('dashboard.users.post_create');
        Route::get('/delete/{id}', [DashboardUsersController::class, 'delete'])->name('dashboard.users.delete');
        Route::put('/update-status/{id}', [DashboardUsersController::class, 'update_status'])->name('dashboard.users.update-status');
    });
    Route::group(['prefix' => 'orders'], function() {
        Route::get('/index', [DashboardOrdersController::class, 'show'])->name('dashboard.orders.index');
        Route::get('/details/{order}', [DashboardOrdersController::class, 'details'])->name('dashboard.orders.details');
        Route::get('/change-status/{order}', [DashboardOrdersController::class, 'change_status'])->name('dashboard.orders.change-status');
    });
    Route::group(['prefix' => 'products'], function() {
        Route::get('/list-products', [DashboardProductsController::class, 'list_products'])->name('dashboard.products.list-products');
        Route::get('/list-types', [DashboardProductsController::class, 'list_types'])->name('dashboard.products.list-types');
        Route::get('/product-details/{id}', [DashboardProductsController::class, 'product_details'])->name('dashboard.products.product-details');

        Route::get('/create-product', [DashboardProductsController::class,'create_product'])->name('dashboard.products.create-product');
        Route::get('/create-product-type', [DashboardProductsController::class,'create_product_type'])->name('dashboard.products.create-product-type');
        Route::post('/post-create-product', [DashboardProductsController::class,'post_create_product'])->name('dashboard.products.post-create-product');
        Route::post('/post-create-product-type', [DashboardProductsController::class,'post_create_product_type'])->name('dashboard.products.post-create-product-type');

        Route::get('/edit-product-type/{id}', [DashboardProductsController::class,'edit_product_type'])->name('dashboard.products.edit-product-type');
        Route::get('/edit-product/{id}', [DashboardProductsController::class,'edit_product'])->name('dashboard.products.edit-product');
        Route::post('/post-edit-product/{id}', [DashboardProductsController::class,'post_edit_product'])->name('dashboard.products.post-edit-product');
        Route::post('/post-edit-product-type/{id}', [DashboardProductsController::class,'post_edit_product_type'])->name('dashboard.products.post-edit-product-type');

        Route::post('/update-sort-order-img-details', [DashboardProductsController::class,'update_sort_order_img_details']);
        Route::put('/update-status-type/{id}', [DashboardProductsController::class,'update_status_type']);
        Route::put('/update-status-product/{id}', [DashboardProductsController::class, 'update_status_product']);
    });
    Route::group(['prefix' => 'promotions'], function() {
        Route::get('/index', [DasboardPromotionController::class, 'index'])->name('dashboard.promotions.index');
    });
});
