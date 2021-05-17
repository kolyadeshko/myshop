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
    public function getProductsByConditions(Request $request, $productsType)
    {

        $productsTypes = [$productsType];
        // проверяем есть ли условие типов продуктов,
        // если да то присваиваем в переменную productTypes
        // чтобы потом по этим типам  выполнить фильтрацию
        $downLevelTypes = $request->input('downLevelTypes');

        if ($downLevelTypes) $productsTypes = $downLevelTypes;

        $products = $this->getProductsByTypes($productsTypes);

        // фыполняем фильтрацию по акциях
        $promotionType = $request->input('promotionType');
        if ($promotionType) $products = $this
            ->getPromotionProductsByFilter($promotionType, $products);


        return $products->orderBy('id')->get();
    }

    private function getPromotionProductsByFilter($promotionType, $products)
    {
        if ($promotionType === 'without') {
            $products = $products->whereNull('discount_price');
        } elseif ($promotionType === 'with') {
            $products = $products->whereNotNull('discount_price');
        }
        return $products;
    }

    private function getPromotionProducts()
    {
        return Product::query()
            ->whereNotNull('discount_price');
    }

    public function getProductBlocks(Request $request)
    {
        $productType = $request->input('type');
        // проверяем, если нужны акционные товары, то
        // вызываем функцию getPromotionProducts
        if ($productType == 'promotion-products') {
            $products = $this->getPromotionProducts();
        } else {
            // если такого типа нету,выдаем ошибку
            abort_if(
                !ProductType::query()->where('id', $productType)->exists(),
                404,
                'Not existing product type'
            );
            $products = $this->getProductsByTypes([$productType]);
        }

        return $products->limit(4)->inRandomOrder()->get();
    }

    /**
     * @param array $productTypesIds
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getProductsByTypes(array $productTypesIds)
    {
        // получаем все типы продуктов в виде массива
        $productTypes = ProductType::all()->toArray();
        // получаем массив идентификаторов категорий, и всех их
        // дочерних категорий
        $productTypesChildrenIds = $this->getChildren($productTypesIds, $productTypes);
        return Product::query()
            ->whereIn('type_id', $productTypesChildrenIds);
    }

    // ids - список идентификаторов категорий, потомков которых мы хотим найти
    // elements - список всех категорий
    private function getChildren($ids, $elements)
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
                $builder->getChildren($elements, $id)
            );
        }
        return $childrenIds;
    }
    public function getSingleProduct($productId)
    {
        return Product::query() -> findOrFail($productId);
    }
}
