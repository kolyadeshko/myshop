<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // отдаем представление для продуктов по категориям
    // передаем тип продукта
    public function getProductsByType($typeId)
    {
        $type = ProductType::query() ->find($typeId);
        return view('products.productsByType',[
            'type' => $type
        ]);
    }

}
