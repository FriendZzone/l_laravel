<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Response;

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



Route::get('/', function () {
    $title = '<h3 style="color:red;">hoc lap trinh tai Unicode</h3>';
    $content = 'PHP - Laravel Framework';
    $dataArr = [
        'item1',
        'item2',
        'item3',
    ];
    return view('clients.demo_test');
})->name('home');
Route::post('/', function () {
    return request()->username;
});

Route::get('/download', [HomeController::class, 'download'])->name('download');

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/product', [HomeController::class, 'product'])->name('product');
// Route::get('/add_product', [HomeController::class, 'getAdd'])->name('get_add_product');
// Route::post('/add_product', [HomeController::class, 'postAdd'])->name('add_product');
// Route::put('/add_product', [HomeController::class, 'putAdd'])->name('put_product');