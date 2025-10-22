<?php
require_once 'php/mapper/Invoice.php';
require_once 'php/mapper/InvoiceLine.php';
require_once 'php/mapper/InvoiceMapper.php';

$inv = new Invoice(null, 'Cliente Teste');
$inv->addLine(new InvoiceLine(null,'X-Burguer',1,18.5));
$inv->addLine(new InvoiceLine(null,'Suco',1,6.0));

$mapper = new InvoiceMapper();
$mapper->save($inv);

echo "Invoice id: {$inv->id}, total: " . $inv->total();

?>