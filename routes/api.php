<?php

use Illuminate\Http\Request;
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
// Возвращает список типов продуктов в иерархической форме
Route::get(
    'product-types',
    [
        App\Http\Controllers\Api\ProductTypes::class,
        'getProductTypes'
    ]
);
// Получает 4 продукта по заданному типу для главной страницы
Route::get(
    'get-product-blocks',
    [
        App\Http\Controllers\Api\ProductsController::class,
        'getProductBlocks'
    ]
);

Route::get(
    'products-type/{productsType}',
    [
        \App\Http\Controllers\Api\ProductsController::class,
        'getProductsByConditions'
    ]
);

// по этому маршруту мы будем получать данные для фильтра продуктов
Route::get(
    'products-filter/{typeId}',
    [
        \App\Http\Controllers\Api\ConditionController::class,
        'getConditionsForProductsFilter'
    ]
);

Route::get(
    'product/{productId}',
    [
        App\Http\Controllers\Api\ProductsController::class,
        'getSingleProduct'
    ]
);

