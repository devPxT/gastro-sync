<?php
require_once __DIR__ . '/php/bootstrap.php';
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/classes/Permissions.php';

$CURRENT_SECTION = 'home.php';

$perm = new Permissions();
$userPerms = $perm->getUserPermissionCodes($_SESSION['user_id'] ?? 0);

// flash
// session_start();
if (session_status() === PHP_SESSION_NONE) session_start();
$flash = $_SESSION['flash_alert'] ?? null;
unset($_SESSION['flash_alert']);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Home</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons (opcional) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="css/styles.css" rel="stylesheet">
  <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
  <script src="js/app.js"></script>
</head>
<body>
  <?php include __DIR__ . '/php/templates/navbar.php'; ?>

  <div class="container mt-4 mb-5">
    <!-- espaço central (removido H2 conforme pedido) -->
    <div class="buttons-wrapper">
      <?php
      $buttons = [
        ['label'=>'Cadastros','link'=>'cadastros/clientes.php','perm'=>'cadastros.view'],
        ['label'=>'Cardápio','link'=>'cardapio.php','perm'=>'cardapio.view'],
        ['label'=>'Estações','link'=>'estacoes.php','perm'=>'estacoes.view'],
        ['label'=>'Estoque','link'=>'estoque.php','perm'=>'estoque.view'],
        ['label'=>'Faturamento','link'=>'faturamento.php','perm'=>'faturamento.view'],
        ['label'=>'Relatórios','link'=>'relatorios.php','perm'=>'relatorios.view'],
      ];
      // exibir somente os permitidos
      $visible = array_filter($buttons, fn($b) => in_array($b['perm'], $userPerms, true));
      // output grid
      echo '<div class="buttons-grid">';
      foreach ($visible as $b) {
        echo '<a class="card-button" href="'.htmlspecialchars($b['link']).'">'.htmlspecialchars($b['label']).'</a>';
      }
      echo '</div>';
      ?>
    </div>
  </div>

  <?php include __DIR__ . '/php/templates/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <?php if ($flash): ?>
    <script>window.FC_FLASH_MESSAGE = <?= json_encode($flash) ?>;</script>
  <?php endif; ?>
</body>
</html>
