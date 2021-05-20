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
})->name('mainpage');

// получить продукты по определенному типу
Route::get('/products-type/{typeId}', [
    \App\Http\Controllers\ProductsController::class,
    'getProductsByType'
]);
Route::get(
    'product/{productId}',
    [
        App\Http\Controllers\ProductsController::class,
        'getSingleProduct'
    ]
) -> middleware('auth');
Route::view('/promotion-products', 'products.promotionProducts');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
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


Route::name('auth.')
    ->middleware('not.login')
    ->group(function () {
        Route::get(
            'login',
            [
                App\Http\Controllers\Auth\LoginController::class,
                'loginForm'
            ]
        )->name('login');
        Route::post(
            'login',
            [
                App\Http\Controllers\Auth\LoginController::class,
                'login'
            ]
        );
        Route::get(
            'register',
            [
                App\Http\Controllers\Auth\RegisterController::class,
                'registerForm'
            ]
        );
        Route::post(
            'register',
            [
                App\Http\Controllers\Auth\RegisterController::class,
                'register'
            ]
        );
        Route::get('/logout', function () {
            auth()->logout();
            return redirect('/');
        })
            ->name('logout')
            ->withoutMiddleware('not.login');
    });


// ajax запросы которые будут использовать сеансы
Route::prefix('api')
    ->middleware('auth')
    ->group(function () {
        // добавление товара в корзину товаров (активную транзакцию)
        Route::post(
            'add-order-to-cart',
            [
                App\Http\Controllers\Api\OrderController::class,
                'addOrderToCart'
            ]
        );
    });
