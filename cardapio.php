<?php
require_once __DIR__ . '/php/bootstrap.php';
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/templates/acl.php';

// check permission and redirect if not allowed
requirePermissionOrRedirect($_SESSION['user_id'], 'cardapio.view');

$CURRENT_SECTION = 'cardapio.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Faturamento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include __DIR__ . '/php/templates/navbar.php'; ?>
  <div class="container mt-4">
    <h2>Cardápio</h2>
    <p>Aqui vai o cardápio...</p>
  </div>
  <?php include __DIR__ . '/php/templates/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
