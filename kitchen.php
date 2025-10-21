<?php
// kitchen.php
require_once __DIR__ . '/php/bootstrap.php';   // logger, ORDER_SUBJECT, etc.
require_once __DIR__ . '/php/auth.php';
require_once __DIR__ . '/php/templates/acl.php';
require_once __DIR__ . '/php/classes/DbConnection.php';
require_once __DIR__ . '/php/classes/Logger.php';

if (session_status() === PHP_SESSION_NONE) session_start();
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'kitchen.view');

// qual seção ativa (para o navbar)
$CURRENT_SECTION = 'kitchen.php';

// conexão
$conn = DbConnection::getInstance()->getConnection();

// Buscar pedidos que estão em preparing
$stmt = $conn->prepare("
    SELECT o.id, o.customer_name, o.table_number, o.total, o.discount, o.status, o.created_at,
           (SELECT method FROM payments p WHERE p.order_id = o.id ORDER BY p.id DESC LIMIT 1) as payment_method
    FROM orders o
    WHERE o.status = 'preparing'
    ORDER BY o.created_at ASC
");
$stmt->execute();
$res = $stmt->get_result();
$orders = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// carregar items por order id em um só batch
$orderIds = array_map(fn($o) => (int)$o['id'], $orders);
$orderItems = [];
if (!empty($orderIds)) {
    $placeholders = implode(',', array_fill(0, count($orderIds), '?'));
    // For dynamic binding, we'll prepare with integer types
    $types = str_repeat('i', count($orderIds));
    $sql = "SELECT order_id, menu_item_id, name, price, quantity FROM order_items WHERE order_id IN ($placeholders) ORDER BY id";
    $stmt2 = $conn->prepare($sql);
    $bind_names[] = $types;
    for ($i=0;$i<count($orderIds);$i++) {
        $param = 'p' . $i;
        $$param = $orderIds[$i];
        $bind_names[] = &$$param;
    }
    call_user_func_array([$stmt2, 'bind_param'], $bind_names);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    while ($r = $res2->fetch_assoc()) {
        $orderItems[intval($r['order_id'])][] = $r;
    }
    $stmt2->close();
}

// default prep time (minutos) — pode personalizar por menu_item no futuro
$defaultPrepMinutes = 15;

// flash
$flash = $_SESSION['flash_alert'] ?? null;
unset($_SESSION['flash_alert']);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cozinha — Pedidos</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
  <script src="js/app.js"></script>
  <style>
    /* ajustes visuais rápidos para a cozinha */
    .kitchen-grid { display:flex; flex-wrap:wrap; gap:18px; }
    .kitchen-card { width: 100%; max-width: 520px; border-radius:8px; padding:16px; box-shadow:0 6px 14px rgba(0,0,0,0.08); background:#fff; }
    .kitchen-card .meta { font-size:0.9rem; color:#666; }
    .kitchen-card .items { margin-top:8px; }
    .kitchen-card .item-row { display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px dashed #eee; }
    .kitchen-card .timer { font-weight:700; }
    .kitchen-card.ready { opacity:0.6; background: linear-gradient(90deg, #e9ffe9, #fff); }
    .kitchen-actions { display:flex; gap:8px; margin-top:12px; justify-content:flex-end; }
  </style>
</head>
<body>
  <?php include __DIR__ . '/php/templates/navbar.php'; ?>

  <div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Cozinha — Pedidos em preparo</h4>
      <div>
        <button id="refreshBtn" class="btn btn-sm btn-secondary">Atualizar</button>
      </div>
    </div>

    <?php if (empty($orders)): ?>
      <div class="alert alert-info">Nenhum pedido em preparo no momento.</div>
    <?php else: ?>
      <div class="kitchen-grid">
        <?php foreach ($orders as $o):
            $oid = (int)$o['id'];
            $createdAt = $o['created_at'];
            $deadline = (new DateTime($createdAt))->modify("+{$defaultPrepMinutes} minutes")->format('c');
            $items = $orderItems[$oid] ?? [];
        ?>
          <div class="kitchen-card" id="order-card-<?= $oid ?>" data-order-id="<?= $oid ?>" data-deadline="<?= $deadline ?>">
            <div class="d-flex justify-content-between">
              <div>
                <div><strong>Pedido #<?= $oid ?></strong></div>
                <div class="meta">Mesa: <?= htmlspecialchars($o['table_number'] ?? '-') ?> — Cliente: <?= htmlspecialchars($o['customer_name'] ?? '-') ?></div>
                <div class="meta">Criado: <?= htmlspecialchars($createdAt) ?> — Pgto: <?= htmlspecialchars($o['payment_method'] ?? '-') ?></div>
              </div>
              <div class="text-end">
                <div class="timer text-danger" id="timer-<?= $oid ?>">—</div>
                <div class="meta">Tempo limite: <?= $defaultPrepMinutes ?> min</div>
              </div>
            </div>

            <div class="items mt-3">
              <?php foreach ($items as $it): ?>
                <div class="item-row">
                  <div><?= htmlspecialchars($it['name']) ?> <small class="text-muted">x<?= intval($it['quantity']) ?></small></div>
                  <div class="text-end">R$ <?= number_format($it['price'] * $it['quantity'], 2, ',', '.') ?></div>
                </div>
              <?php endforeach; ?>
            </div>

            <div class="mt-2">
              <strong>Total:</strong> R$ <?= number_format($o['total'], 2, ',', '.') ?>
            </div>

            <div class="kitchen-actions">
              <button class="btn btn-sm btn-success mark-ready" data-order-id="<?= $oid ?>">Marcar como pronto</button>
              <button class="btn btn-sm btn-outline-secondary btn-refresh-order" data-order-id="<?= $oid ?>">Atualizar</button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php include __DIR__ . '/php/templates/footer.php'; ?>

  <script>
  // kitchen.js inline
  $(function(){
    function updateTimerFor(card) {
      const deadline = new Date(card.data('deadline'));
      const now = new Date();
      const diffMs = deadline - now;
      const $timer = card.find('.timer');
      if (diffMs >= 0) {
        // remaining
        const m = Math.floor(diffMs / 60000);
        const s = Math.floor((diffMs % 60000) / 1000);
        $timer.text(`${m}m ${s}s`);
        $timer.removeClass('text-danger').addClass('text-success');
      } else {
        // overdue
        const overdue = Math.abs(diffMs);
        const m = Math.floor(overdue / 60000);
        const s = Math.floor((overdue % 60000) / 1000);
        $timer.text(`ATRASADO ${m}m ${s}s`);
        $timer.removeClass('text-success').addClass('text-danger');
      }
    }

    // initial timers
    $('.kitchen-card').each(function(){
      updateTimerFor($(this));
    });

    // refresh timers every second
    setInterval(function(){
      $('.kitchen-card').each(function(){ updateTimerFor($(this)); });
    }, 1000);

    // mark ready via AJAX
    $(document).on('click', '.mark-ready', function(){
      const orderId = $(this).data('order-id');
      if (!confirm('Marcar pedido #' + orderId + ' como PRONTO?')) return;
      const $btn = $(this);
      $btn.prop('disabled', true).text('Processando...');
      $.post('php/kitchen_action.php', { order_id: orderId, action: 'ready' }, function(resp){
        if (resp && resp.ok) {
          showAlert(resp.msg || 'Marcado como pronto');
          // fade/mark card as ready, then remove after 2s
          const $card = $('#order-card-' + orderId);
          $card.addClass('ready');
          $btn.text('Pronto').prop('disabled', true);
          setTimeout(()=> $card.fadeOut(400, ()=> $card.remove()), 1500);
        } else {
          showAlert(resp && resp.msg ? resp.msg : 'Falha ao marcar pronto');
          $btn.prop('disabled', false).text('Marcar como pronto');
        }
      }, 'json').fail(function(){
        showAlert('Erro de rede ao marcar pronto.');
        $btn.prop('disabled', false).text('Marcar como pronto');
      });
    });

    // manual refresh button
    $('#refreshBtn').on('click', function(){ location.reload(); });
    $(document).on('click', '.btn-refresh-order', function(){ location.reload(); });
  });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <?php if ($flash): ?>
    <script>window.FC_FLASH_MESSAGE = <?= json_encode($flash) ?>;</script>
  <?php endif; ?>
</body>
</html>
