<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(CategoryController::class)->prefix('/categories')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
});

Route::controller(ProductController::class)->prefix('/products')->group(function () {
    Route::get('/', 'index')->name('products');
    Route::post('/', 'store')->name('products.store');
});

Route::controller(UploadController::class)->prefix('/upload')->group(function () {
    Route::post('/image', 'storeImage');
});
