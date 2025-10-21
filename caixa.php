<?php
// caixa.php
require_once __DIR__ . '/php/bootstrap.php';
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/templates/acl.php';
require_once __DIR__ . '/php/classes/DbConnection.php';
require_once __DIR__ . '/php/classes/Permissions.php';

if (session_status() === PHP_SESSION_NONE) session_start();
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'caixa.view');

$CURRENT_SECTION = 'caixa.php'; // ou 'caixa.php' se preferir

// carrega itens do cardápio do DB (fonte da verdade para preços)
$conn = DbConnection::getInstance()->getConnection();
$res = $conn->query("SELECT id, name, price FROM menu_items ORDER BY name");
$menuItems = [];
while ($r = $res->fetch_assoc()) $menuItems[] = $r;

// echo '<pre>';
// print_r($menuItems);
// echo '</pre>';

// flash
$flash = $_SESSION['flash_alert'] ?? null;
unset($_SESSION['flash_alert']);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Caixa</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
  <script src="js/app.js"></script>
  <script src="js/caixa.js"></script>
</head>
<body>
  <?php include __DIR__ . '/php/templates/navbar.php'; ?>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card p-3 mb-3">
          <h5>Registrar Pedido</h5>
          <form id="caixaForm" action="php/process_caixa.php" method="POST" autocomplete="off">
            <div class="mb-3">
              <label class="form-label">Nome do Cliente (opcional)</label>
              <input name="customer_name" class="form-control" placeholder="Nome do cliente (sem cadastro)">
            </div>

            <div class="mb-3">
              <label class="form-label">Mesa</label>
              <input name="table_number" class="form-control" placeholder="Número/Identificação da mesa">
            </div>

            <div class="mb-3">
              <label class="form-label">Adicionar Item</label>
              <div class="input-group">
                <select id="menuSelect" class="form-select">
                  <option value="">-- selecione um item --</option>
                 
                  <option value="2" data-name="Batata Frita" data-price="8,00">Batata Frita — R$ 8,00</option>
                  <option value="3" data-name="Suco Natural" data-price="6,00">Suco Natural — R$ 6,00</option>
                  <option value="1" data-name="X-Burguer" data-price="18,50">X-Burguer — R$ 18,50</option>
                </select>
                <input id="menuQty" type="number" class="form-control" value="1" min="1" style="max-width:90px;">
                <button id="addItemBtn" class="btn btn-primary">Adicionar</button>
              </div>
            </div>

            <hr>

            <h6>Itens do Pedido</h6>
            <div class="table-responsive mb-3">
              <table id="cartTable" class="table">
                <thead>
                  <tr><th>Item</th><th>Preço</th><th>Qtd</th><th>Subtotal</th><th></th></tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>

            <div class="mb-3">
              <label class="form-label">Desconto</label>
              <div class="input-group">
                <select id="discountType" class="form-select" name="discount_type" style="max-width:160px;">
                  <option value="none">Nenhum</option>
                  <option value="percent">Percentual (%)</option>
                  <option value="fixed">Valor fixo</option>
                </select>
                <input id="discountValue" type="number" step="0.01" class="form-control" name="discount_value" placeholder="0.00" value="0.00" style="max-width:160px;">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Método de Pagamento</label>
              <select id="paymentMethod" name="payment_method" class="form-select mb-2">
                <option value="cash">Dinheiro</option>
                <option value="card">Cartão</option>
                <option value="pix">PIX</option>
              </select>

              <div id="paymentFields">
                <div id="cashFields" class="pay-block">
                  <label>Recebido (Dinheiro)</label>
                  <input type="number" step="0.01" name="cash_received" class="form-control" placeholder="Valor recebido" />
                </div>

                <div id="cardFields" class="pay-block" style="display:none;">
                  <label>Número do Cartão</label>
                  <input type="text" name="card_number" class="form-control" placeholder="**** **** **** 1234" />
                  <label class="mt-2">Parcelas</label>
                  <input type="number" name="installments" class="form-control" value="1" min="1" />
                </div>

                <div id="pixFields" class="pay-block" style="display:none;">
                  <label>Chave PIX</label>
                  <input type="text" name="pix_key" class="form-control" placeholder="Chave PIX" />
                </div>
              </div>
            </div>

            <div class="mb-3">
              <p>Subtotal: <strong id="displaySubtotal">R$ 0,00</strong></p>
              <p>Desconto: <strong id="displayDiscount">R$ 0,00</strong></p>
              <p>Total a Pagar: <strong id="displayTotal">R$ 0,00</strong></p>
            </div>

            <!-- hidden: carrinho em JSON (apenas ids e qty) -->
            <input type="hidden" name="cart_json" id="cartJson" />

            <button id="submitBtn" type="submit" class="btn btn-success">Registrar Pedido e Pagar</button>
          </form>
        </div>
      </div>

      <!-- <div class="col-lg-5">
        <div class="card p-3 mb-3">
          <h5>Atalhos / Observações</h5>
          <p>Após registrar o pedido o estoque será decrementado (se houver recipes) e a cozinha receberá notificação.</p>
        </div>
      </div> -->
    </div>
  </div>

  <?php include __DIR__ . '/php/templates/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <?php if ($flash): ?>
    <script>window.FC_FLASH_MESSAGE = <?= json_encode($flash) ?>;</script>
  <?php endif; ?>
</body>
</html>
