<?php
require_once 'php/active/Product.php';
require_once 'php/active/Category.php';

// criar categoria
$c = new Category(['name' => 'Bebidas']);
$c->save();

// criar produto
$p = new Product(['name'=>'Suco de Laranja','price'=>6.00,'category_id'=>$c->id]);
$p->save();

// buscar
$found = Product::find($p->id);
echo $found->name;

?>