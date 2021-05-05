<?php


namespace App;


class TreeBuilder
{


    public function buildTree(
        array $elements,
        $parentId = 0,
        $parentIdFieldName = 'parent_id'
    )
    {
        $branch = array();
        foreach ($elements as $element)
        {
            if ($element[$parentIdFieldName] == $parentId)
            {
                $children = $this -> buildTree($elements,$element['id']);
                if ($children)
                {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function getChildren(array $elements,$id)
    {
        $children = [$id];
        foreach ($elements as $element)
        {
            if($element['parent_id'] == $id)
            {
                $children[] = $element['id'];
                $children = array_merge($children,$this->getChildren($elements,$element['id']));
            }

        }
        return array_unique($children);
    }

}
