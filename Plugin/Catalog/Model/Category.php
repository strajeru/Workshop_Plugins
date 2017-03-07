<?php
namespace Workshop\Plugins\Plugin\Catalog\Model;

class Category
{
    public function afterGetName(\Magento\Catalog\Model\Category $category, $name)
    {
        return $name . ' ('.__('ID:').$category->getId().')';
    }
}
