<?php
require_once __DIR__ . '/php/bootstrap.php';
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/templates/acl.php';

// check permission and redirect if not allowed
requirePermissionOrRedirect($_SESSION['user_id'], 'estacoes.view');

$CURRENT_SECTION = 'estacoes.php';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Estações</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>
  <?php include __DIR__ . '/php/templates/navbar.php'; ?>
  <div class="container mt-4">
    <h2>Estações</h2>
    <p>Aqui vão as estações...</p>
  </div>
  <?php include __DIR__ . '/php/templates/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
