<?php
// php/active/Product.php
require_once __DIR__ . '/ActiveRecord.php';
require_once __DIR__ . '/Category.php';

class Product extends ActiveRecord
{
    protected static string $table = 'ar_products';

    public function category(): ?Category
    {
        if (empty($this->attributes['category_id'])) return null;
        return Category::find((int)$this->attributes['category_id']);
    }
}
