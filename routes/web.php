<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});


# Category Api Route

Route::resource('category', CategoryController::class);
Route::get('get-all-category', [CategoryController::class, 'GetAllCategory'])->name('get-all-category');


Route::get('single-category/{id}', [CategoryController::class, 'singleCategory'])->name('single-category');

// Route::get('single-category/{id}',[CategoryController::class, 'show'])->name('single-category');


Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('category.show');

// Product Api Route


// Route::resource('product',ProductController::class);
Route::get('get-all-product', [ProductController::class, 'GetAllProduct'])->name('get-all-product');
// Route::get('single-product/{id}',[ProductController::class, 'singleProduct'])->name('single-product');

// Route::apiResource('categories', CategoryController::class);

Route::resource('product', ProductController::class);

// Student Route


// Blog Route

Route::resource('blog', BlogController::class);

Route::get('get-all-blog', [BlogController::class, 'GetAllBlog'])->name('get-all-blog');
