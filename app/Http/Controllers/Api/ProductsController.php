<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getProductTypes()
    {
        function buildTree(array $elements,$parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element)
            {
                if ($element['parent_id'] == $parentId)
                {
                    $children = buildTree($elements,$element['id']);
                    if ($children)
                    {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }
        $types = \App\Models\ProductType::all()
            -> toArray();
        $types = buildTree($types);
        return response() -> json($types);
    }
}
