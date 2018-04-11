<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Menu;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (Schema::hasTable('menus')) {
            if(Cache::has('menus')) {
                $menus = Cache::get('menus');
            } else {
                $menus = Menu::active()->get();
                Cache::put('menus', $menus, now()->addMinutes(config('platform.menus-cache-time')));
            }
            View::share('menus', $menus);
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
