<?php
require_once __DIR__ . '/php/bootstrap.php'; // garante logger, db e globals
require_once __DIR__ . '/php/auth.php';      // protege a página
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Home</title></head>
<body>
  <h1>Bem-vindo, <?php echo htmlspecialchars($CURRENT_USERNAME); ?>!</h1>
  <p>Esta é a home do aplicativo (somente para usuários logados).</p>
  <p><a href="php/logout.php">Sair</a></p>
</body>
</html>
