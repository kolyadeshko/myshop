<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TreeBuilder;
use Illuminate\Http\Request;

class ProductTypes extends Controller
{
    /**
     * Получаем типы продуктов в виде дерева
     *
     * @param TreeBuilder $builder
     * @return array
     */
    public function getProductTypes(TreeBuilder $builder)
    {
        // получаем все типы продуктов в виде массива
        $types = \App\Models\ProductType::all()
            -> toArray();
        // преобразовуем в древовидную структуру
        $types = $builder -> buildTree($types);
        return $types;
    }
}
