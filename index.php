<?php
// ...existing code...
require_once 'php/classes/dbconnection.php';

$db = DbConnection::getInstance()->getConnection();
// ...use $db for queries...

?>