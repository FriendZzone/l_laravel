<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Client Routes
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/edit/{id}', [CategoryController::class, 'getCategory']);
    Route::post('/edit/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::get('/add', [CategoryController::class, 'addCategory'])->name('category.add');
    Route::post('/add', [CategoryController::class, 'handleAddCategory'])->name('category.handleAdd');
    Route::delete('/delelte/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    Route::post('/upload', [CategoryController::class, 'handleFileCategory'])->name('category.handleFile');
    Route::get('/upload', [CategoryController::class, 'fileCategory'])->name('category.fileCategory');
});


Route::prefix('admin')->middleware('checkAdminLogin')->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index']);
    Route::resource('products', ProductsController::class)->middleware('productPermission');
});



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/add_product', [HomeController::class, 'getAdd'])->name('get_add_product');
Route::post('/add_product', [HomeController::class, 'postAdd'])->name('add_product');
Route::put('/add_product', [HomeController::class, 'putAdd'])->name('put_product');
// Route::get('/product', function () {
//     return view('product');
// });

// Route::post('/product', function () {
//     return json_encode(123);
// });
// Route::get('/user', function () {
//     $user = new User();
//     $all_users = $user::all();
//     dd($all_users);
//     return view('product');
// });
// Route::get('/product/{id}', [HomeController::class, 'product']);
// Route::prefix('admin')->middleware('CheckPermission')->group(function () {
//     Route::get('/form/{id}_{slug?}', function ($id, $slugs = 1) {
//         $content = 'id nhap vao la' . $id . ' slug nhap vao la ' . $slugs;
//         return $content;
//     })->where('slug', '[a-z-]+')->where('id', '[0-9]+')->name('admin.form-variables');
//     Route::get('/form', function () {
//         return view('form');
//     })->name('admin.show-form');
//     Route::post('/welcome', function () {
//         return view('welcome');
//     });
// });
