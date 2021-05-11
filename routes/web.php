<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {

    return view('index');
});

Route::get('/products-type/{typeId}',[
    \App\Http\Controllers\ProductsController::class,
    'getProductsByType'
]);

Route::view('/promotion-products','products.promotionProducts');

Route::prefix('admin')
    ->name('admin.')
    ->group(function (){
        Route::get(
            '/add-product',
            [
                App\Http\Controllers\Admin\ProductController::class,
                'create'
            ]
        );
        Route::post(
            '/add-product',
            [
                App\Http\Controllers\Admin\ProductController::class,
                'store'
            ]
        );
    });


