<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Alert;
use App\View\Components\Input\Button;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('datetime', function ($expression) {
            return ($expression)->format('m/d/Y H:i');
        });
        //
        Blade::if('env', function ($value) {
            // return boolean value
            if (config('constant.constant_1') === $value) {
                return true;
            } 
            return false;
        });
        Blade::component('package-alert', Alert::class);
        Blade::component('package-button', Button::class);
    }
}
