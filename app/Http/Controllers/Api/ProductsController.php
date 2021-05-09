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



    public function getProductsByConditions(Request $request)
    {
        $type = $request -> input( 'type');
        $products = $this -> getProductsByTypes([$type]);
        return $products -> get();
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

    /**
     * @param array $productTypesIds
     * @return \Illuminate\Database\Eloquent\Builder
     */
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

    // ids - список идентификаторов категорий, потомков которых мы хотим найти
    // elements - список всех категорий
    private function getChildren($ids,$elements)
    {
        // создаем объект клсса TreeBuilder
        $builder = App::make(TreeBuilder::class);
        // массив из id всех потомков
        $childrenIds = [];
        foreach ($ids as $id) {
            // для каждого идентификатора находим всех потомков
            // и добавляем в список childrenIds
            $childrenIds = array_merge(
                $childrenIds,
                $builder -> getChildren($elements,$id)
            );
        }
        return $childrenIds;
    }


}
