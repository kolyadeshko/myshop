<?php

namespace App\Http\Controllers\Api;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConditionController extends Controller
{
    public function getConditionsForProductsFilter(Request $request,$typeId)
    {
        $downLevelTypes = $this -> getLevelDownTypes($typeId);
        return [
            'downLevelTypes' => $downLevelTypes
        ];
    }

    private function getLevelDownTypes($typeId)
    {
        // получаем все типы продуктов у которых родительским типом
        // является данный тип
        $productTypes = ProductType::query()
            -> where('parent_id',$typeId)
            ->get();
        // если таких типов нет - возвращаем false
        return $productTypes->isNotEmpty() ? $productTypes : false;
    }
}
