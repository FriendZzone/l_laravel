<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::creating(function ($user) {
            file_put_contents(base_path() . '/logs.txt', $user->email);
        });
    }
}
