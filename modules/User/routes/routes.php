<?php

use Illuminate\Support\Facades\Route;
// use Modules\User\src\Http\Controllers\UserController;

Route::get('/user121', function () {
    return config('config.test');
})->middleware('demo');

// Route::get('/users', [UserController::class, 'index']);
Route::group(['namespace' => 'Modules\User\src\Http\Controllers'], function () {
    Route::get('/users', 'UserController@index');
});
