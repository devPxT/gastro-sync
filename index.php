<?php
require_once __DIR__ . '/php/bootstrap.php';

// Singeleton
require_once 'php/classes/dbconnection.php';

$db = DbConnection::getInstance()->getConnection();
// ...use $db for queries...



// Criando items usando Factory Method (MenuRepository (le banco e verifica cardapio) delega a MenuFactory que delega ao Creator)
$repo = new MenuRepository();
$rows = $repo->all(); // array com ['entity'=>MenuItem, 'db'=>row]

// exibir
foreach ($rows as $r) {
    $item = $r['entity'];
    echo '<div>';
    echo '<h4>' . htmlspecialchars($item->name) . '</h4>';
    echo '<p>' . htmlspecialchars($item->getDescription()) . '</p>';
    echo '</div>';
}

?>