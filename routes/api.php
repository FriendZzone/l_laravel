<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UsersController;
use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('users')->name('users.')->middleware(['auth:api'])->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/{user}', [UsersController::class, 'detail'])->name('detail');
    Route::post('/', [UsersController::class, 'create'])->name('create');
    Route::put('/{user}', [UsersController::class, 'update'])->name('updatePut');
    Route::patch('/{user}', [UsersController::class, 'update'])->name('updatePatch');
    Route::delete('/{user}', [UsersController::class, 'delete'])->name('delete');
});

Route::apiResource('products', ProductController::class);
Route::post('login', [AuthController::class, 'login']);
Route::get('getToken', [AuthController::class, 'getToken'])->middleware(['auth:sanctum']);
Route::get('refreshToken', [AuthController::class, 'refreshToken']);

Route::post('logout', [AuthController::class, 'logout']);
Route::get('passportToken', function () {
    $user = User::find(2);
    $tokenResult = $user->createToken('auth_token');

    // set expire time 
    $tokenResult->expires_at = Carbon::now()->addMinutes(60);
    $expiredTime = Carbon::parse($tokenResult->expires_at)->toDateTimeString();

    // access token
    $access_token = $tokenResult->accessToken;

    $response = [
        'access_token' => $access_token,
        'expires_at' => $expiredTime
    ];
    return $response;
});

Route::get('/sendMail', function () {
    $email = 'datdh@omegatheme.com';
    $name = 'dat';
    $subject = 'Welcome to Laravel';
    $content = "<p>Hello $name</p>";
    $mail = Mail::raw($content, function ($mesage) use ($email, $subject) {
        $mesage->to($email)
            ->subject($subject);
    });
    dd($mail);
    // $job = (new SendWelcomeEmail())->delay(Carbon::now()->addSeconds(4));
    // dispatch($job);
});
