<?php
// php/reorder_api.php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/classes/DbConnection.php';
require_once __DIR__ . '/classes/Logger.php';

if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/templates/acl.php';
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'reorders.view');

header('Content-Type: application/json; charset=utf-8');

$action = $_REQUEST['action'] ?? 'list';
$conn = DbConnection::getInstance()->getConnection();

try {
    if ($action === 'list') {
        // listar com join ingredients
        $sql = "SELECT r.*, i.name as ingredient_name, i.unit, i.unit_price
                FROM reorders r
                JOIN ingredients i ON i.id = r.ingredient_id
                ORDER BY r.created_at DESC";
        $res = $conn->query($sql);
        $out = [];
        while ($r = $res->fetch_assoc()) $out[] = $r;
        echo json_encode(['ok'=>true,'data'=>$out]);
        exit;
    }

    if ($action === 'mark_received') {
        $id = intval($_POST['id'] ?? 0);
        $received_qty = floatval($_POST['received_quantity'] ?? 0);
        $note = trim($_POST['note'] ?? null);
        if ($id <= 0) throw new Exception('ID inválido');

        // buscar reorder
        $stmt = $conn->prepare("SELECT ingredient_id, quantity, status FROM reorders WHERE id = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if (!$row) throw new Exception('Reorder não encontrado');

        if ($row['status'] === 'received') throw new Exception('Já recebido');

        // decidir qty to add: se recebido_quantity informado usa ele, senão usa quantity
        $toAdd = $received_qty > 0 ? $received_qty : (float)$row['quantity'];

        // transaction: update ingredients quantity and reorder status
        $conn->begin_transaction();

        // update ingredient quantity
        $stmt2 = $conn->prepare("UPDATE ingredients SET quantity = quantity + ?, updated_at = NOW() WHERE id = ?");
        $stmt2->bind_param('di', $toAdd, $row['ingredient_id']);
        $ok1 = $stmt2->execute();
        $stmt2->close();

        // update reorder
        $stmt3 = $conn->prepare("UPDATE reorders SET status='received', received_at = NOW(), note = ?, quantity = ? WHERE id = ?");
        $stmt3->bind_param('sdi', $note, $toAdd, $id);
        $ok2 = $stmt3->execute();
        $stmt3->close();

        if ($ok1 && $ok2) {
            $conn->commit();
            Logger::getInstance()->log('info', "Reorder recebido e estoque atualizado", ['reorder_id'=>$id, 'ingredient_id'=>$row['ingredient_id'], 'quantity_added'=>$toAdd]);
            echo json_encode(['ok'=>true]);
        } else {
            $conn->rollback();
            throw new Exception('Falha ao atualizar DB');
        }
        exit;
    }

    if ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception('ID inválido');
        $stmt = $conn->prepare("DELETE FROM reorders WHERE id = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        if ($ok) {
            Logger::getInstance()->log('info', "Reorder removido (id={$id})", ['reorder_id'=>$id]);
            echo json_encode(['ok'=>true]);
        } else throw new Exception('Falha ao remover');
        exit;
    }

    if ($action === 'add') {
        // optional: manual creation from UI
        $ingredient_id = intval($_POST['ingredient_id'] ?? 0);
        $quantity = floatval($_POST['quantity'] ?? 0);
        $note = trim($_POST['note'] ?? null);
        if ($ingredient_id <= 0 || $quantity <= 0) throw new Exception('Parâmetros inválidos');
        $stmt = $conn->prepare("INSERT INTO reorders (ingredient_id, quantity, status, note) VALUES (?, ?, 'requested', ?)");
        $stmt->bind_param('ids', $ingredient_id, $quantity, $note);
        $ok = $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();
        if ($ok) {
            Logger::getInstance()->log('info', "Reorder criado manualmente", ['reorder_id'=>$id,'ingredient_id'=>$ingredient_id,'quantity'=>$quantity]);
            echo json_encode(['ok'=>true,'id'=>$id]);
        } else throw new Exception('Falha ao criar reorder');
        exit;
    }

    http_response_code(400);
    echo json_encode(['ok'=>false,'msg'=>'Ação inválida']);
    exit;

} catch (Throwable $e) {
    if (class_exists('Logger')) Logger::getInstance()->log('error', 'reorder_api error: '.$e->getMessage(), ['action'=>$action, 'post'=>$_POST]);
    http_response_code(500);
    echo json_encode(['ok'=>false,'msg'=>$e->getMessage()]);
    exit;
}
