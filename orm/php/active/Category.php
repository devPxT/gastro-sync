<?php
// php/active/Category.php
require_once __DIR__ . '/ActiveRecord.php';

class Category extends ActiveRecord
{
    protected static string $table = 'ar_categories';

    public function products(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM ar_products WHERE category_id = ?");
        $stmt->execute([$this->id]);
        $rows = $stmt->fetchAll();
        $list = [];
        foreach ($rows as $r) $list[] = new Product($r);
        return $list;
    }
}
