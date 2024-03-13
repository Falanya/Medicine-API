<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public $bindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Services\Interfaces\ProvinceServiceInterface' => 'App\Services\ProvinceService',
        'App\Services\Interfaces\DistrictServiceInterface' => 'App\Services\DistrictService',
        'App\Services\Interfaces\WardServiceInterface' => 'App\Services\WardService',
    ];
    public function register(): void
    {
        foreach($this->bindings as $key => $val) {
            $this->app->bind($key,$val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function($view) {
            if ($user = auth()->user()) {
                $cart = Cart::where([
                    'user_id' => $user->id,
                    'status' => 1,
                ])->count();
                $view->with(compact('cart'));
            }
            
        });
    }
}