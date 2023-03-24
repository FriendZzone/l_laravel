<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
Route::prefix('/')->group(function () {
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'add'])->name('add');
    Route::post('/add', [UserController::class, 'postAdd'])->name('postAdd');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit', [UserController::class, 'postEdit'])->name('postEdit');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
});


Route::prefix('post')->name('post.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/add', [PostController::class, 'add'])->name('add');
    Route::get('/update/{id}', [PostController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
    Route::get('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('force-delete');
    Route::get('/restore/{id}', [PostController::class, 'restore'])->name('restore');
    Route::post('/deleteAny', [PostController::class, 'deleteAny'])->name('deleteAny');
});

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/add_product', [HomeController::class, 'getAdd'])->name('get_add_product');
// Route::post('/add_product', [HomeController::class, 'postAdd'])->name('add_product');
// Route::put('/add_product', [HomeController::class, 'putAdd'])->name('put_product');