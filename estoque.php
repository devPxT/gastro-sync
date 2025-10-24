<?php
// estoque.php
require_once __DIR__ . '/php/bootstrap.php';
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/templates/acl.php';
require_once __DIR__ . '/php/classes/DbConnection.php';

if (session_status() === PHP_SESSION_NONE) session_start();
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'estoque.view');

$CURRENT_SECTION = 'estoque.php';

// flash
$flash = $_SESSION['flash_alert'] ?? null;
unset($_SESSION['flash_alert']);

function format_quantity(float $qty, int $maxDecimals = 3): string
{
    // Formata com decimais fixos, sem separador de milhares
    $s = number_format($qty, $maxDecimals, ',', '');
    // remove zeros à direita e vírgula sobrando
    $s = rtrim($s, '0');
    $s = rtrim($s, ',');
    // se string vazia (p.ex. 0,000) retorna "0"
    return $s === '' ? '0' : $s;
}

?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Estoque</title>
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
      <h4>Estoque</h4>
      <div>
        <button id="btnAddIngredient" class="btn btn-primary">Adicionar ingrediente</button>
        <a href="recompras.php" class="btn btn-secondary">Recompras</a>
      </div>
    </div>

    <div id="stockAlert"></div>

    <div class="table-responsive">
      <table class="table table-striped" id="stockTable">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Unidade</th>
            <th>Threshold</th>
            <th>Preco Unit.</th>
            <th>Atualizado</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <?php include __DIR__ . '/php/templates/footer.php'; ?>

  <!-- Modal: Add/Edit Ingredient -->
  <div class="modal fade" id="ingredientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <form id="ingredientForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ingredientModalLabel">Adicionar ingrediente</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="ing_id" value="">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input name="name" id="ing_name" class="form-control" required>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label class="form-label">Quantidade</label>
              <input name="quantity" id="ing_quantity" type="number" step="0.001" class="form-control" value="0.000">
            </div>
            <div class="col">
              <label class="form-label">Threshold</label>
              <input name="threshold" id="ing_threshold" type="number" step="0.001" class="form-control" value="0.000">
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col">
              <label class="form-label">Unidade</label>
              <input name="unit" id="ing_unit" class="form-control" placeholder="un, kg, ml...">
            </div>
            <div class="col">
              <label class="form-label">Preço unitário (opcional)</label>
              <input name="unit_price" id="ing_unit_price" type="number" step="0.01" class="form-control" value="0.00">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Observação</label>
            <textarea name="note" id="ing_note" class="form-control" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/estoque.js"></script>

  <?php if ($flash): ?>
    <script>window.FC_FLASH_MESSAGE = <?= json_encode($flash) ?>;</script>
  <?php endif; ?>
</body>
</html>
