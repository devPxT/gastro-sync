<?php
// recompras.php
require_once __DIR__ . '/php/bootstrap.php';
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/templates/acl.php';
require_once __DIR__ . '/php/classes/DbConnection.php';

if (session_status() === PHP_SESSION_NONE) session_start();
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'reorders.view');

$CURRENT_SECTION = 'estoque.php'; // keeps the menu highlighting to Estoque or Recompras as you prefer

$flash = $_SESSION['flash_alert'] ?? null;
unset($_SESSION['flash_alert']);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Recompras</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
  <script src="js/app.js"></script>
</head>
<body>
  <?php include __DIR__ . '/php/templates/navbar.php'; ?>

  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Recompras</h4>
      <div>
        <button id="btnAddReorder" class="btn btn-primary">Criar Recompra</button>
        <a href="estoque.php" class="btn btn-secondary">Estoque</a>
      </div>
    </div>

    <div id="reorderAlert"></div>

    <div class="table-responsive">
      <table class="table table-bordered" id="reorderTable">
        <thead>
          <tr>
            <th>ID</th><th>Ingrediente</th><th>Quantidade</th><th>Estimativa R$</th><th>Status</th><th>Criado</th><th>Recebido em</th><th>Ações</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <?php include __DIR__ . '/php/templates/footer.php'; ?>

  <!-- Modal: Create/Edit Reorder -->
  <div class="modal fade" id="reorderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="reorderForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nova Recompra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="reorder_id" name="id" value="">
          <div class="mb-3">
            <label class="form-label">Ingrediente</label>
            <select name="ingredient_id" id="reorder_ingredient" class="form-select"></select>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label class="form-label">Quantidade</label>
              <input name="quantity" id="reorder_quantity" type="number" step="0.001" class="form-control">
            </div>
            <div class="col">
              <label class="form-label">Observação</label>
              <input name="note" id="reorder_note" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Mark Received -->
  <div class="modal fade" id="markReceivedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="markReceivedForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Marcar como Recebido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="mark_reorder_id" name="id" value="">
          <div class="mb-3">
            <label class="form-label">Quantidade Recebida (deixe em branco para usar a quantidade pedida)</label>
            <input name="received_quantity" id="mark_received_qty" type="number" step="0.001" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Observação</label>
            <input name="note" id="mark_note" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-success">Marcar como Recebido</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/reorders.js"></script>

  <?php if ($flash): ?>
    <script>window.FC_FLASH_MESSAGE = <?= json_encode($flash) ?>;</script>
  <?php endif; ?>
</body>
</html>
