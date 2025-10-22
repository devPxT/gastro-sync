<?php
require_once 'php/gateway/SupplierGateway.php';
require_once 'php/gateway/ReorderGateway.php';

$sG = new SupplierGateway();
$sG->insert(['name'=>'Fornecedores Ltda','contact'=>'Fulano','phone'=>'(11)99999-9999']);

$rG = new ReorderGateway();
$rG->insert(1, 20.0, 200.00); // ingredient_id 1, qty 20
$pend = $rG->findPending();
?>