<?php
// php/kitchen_action.php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/classes/DbConnection.php';
require_once __DIR__ . '/classes/Logger.php';

// session + permission check
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/templates/acl.php';
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'kitchen.view');

// Expect JSON or form POST
$orderId = isset($_POST['order_id']) ? (int)$_POST['order_id'] : (int)($_GET['order_id'] ?? 0);
$action  = $_POST['action'] ?? $_GET['action'] ?? null;

header('Content-Type: application/json; charset=utf-8');

if ($orderId <= 0 || !$action) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'msg' => 'Parâmetros inválidos.']);
    exit;
}

try {
    // usamos o OrderSubject já registrado no bootstrap (global)
    if (! isset($GLOBALS['ORDER_SUBJECT'])) {
        throw new Exception('ORDER_SUBJECT não encontrado (verifique bootstrap).');
    }

    if ($action === 'ready') {
        $ok = $GLOBALS['ORDER_SUBJECT']->updateStatus($orderId, 'ready');
        if ($ok) {
            echo json_encode(['ok' => true, 'msg' => "Pedido #{$orderId} marcado como pronto."]);
            exit;
        } else {
            http_response_code(500);
            echo json_encode(['ok' => false, 'msg' => 'Falha ao atualizar pedido.']);
            exit;
        }
    } elseif ($action === 'cancel') {
        // opcional: permitir cancelamento
        $ok = $GLOBALS['ORDER_SUBJECT']->updateStatus($orderId, 'cancelled');
        echo json_encode(['ok' => (bool)$ok, 'msg' => $ok ? 'Pedido cancelado' : 'Falha ao cancelar']);
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['ok' => false, 'msg' => 'Ação desconhecida.']);
        exit;
    }
} catch (Throwable $e) {
    if (class_exists('Logger')) Logger::getInstance()->log('error', 'kitchen_action error: ' . $e->getMessage(), ['order_id'=>$orderId,'action'=>$action]);
    http_response_code(500);
    echo json_encode(['ok' => false, 'msg' => 'Erro interno: ' . $e->getMessage()]);
    exit;
}
