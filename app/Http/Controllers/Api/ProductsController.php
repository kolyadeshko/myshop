<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\TreeBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductsController extends Controller
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

    private function getPromotionProducts()
    {
        return Product::query()
            -> whereNotNull('discount_price');
    }

    public function getProductBlocks(Request $request)
    {
        $productType = $request -> input('type');
        // проверяем, если нужны акционные товары, то
        // вызываем функцию getPromotionProducts

        if ($productType == 'promotion-products')
        {
            $products = $this -> getPromotionProducts();
        } else {
            // если такого типа нету,выдаем ошибку
            abort_if(
                !ProductType::query() -> where('id',$productType) -> exists(),
                404,
                'Not existing product type'
            );
            $products = $this -> getProductsByTypes([$productType]);
        }

        return $products -> limit(4) -> get();
    }

    private function getProductsByTypes(array $productTypesIds)
    {
        // получаем все типы продуктов в виде массива
        $productTypes = ProductType::all() -> toArray();
        // получаем массив идентификаторов категорий, и всех их
        // дочерних категорий
        $productTypesChildrenIds = $this->getChildren($productTypesIds,$productTypes);
        return Product::query()
            -> whereIn('type_id',$productTypesChildrenIds);
    }

    private function getChildren($ids,$elements)
    {
        $builder = App::make(TreeBuilder::class);
        $childrenIds = [];
        foreach ($ids as $id) {
            $childrenIds = array_merge(
                $childrenIds,
                $builder -> getChildren($elements,$id)
            );
        }
        return $childrenIds;
    }


}
