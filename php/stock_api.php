<?php
// php/stock_api.php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/classes/DbConnection.php';
require_once __DIR__ . '/classes/Logger.php';

if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/templates/acl.php';
requirePermissionOrRedirect($_SESSION['user_id'] ?? 0, 'estoque.view');

header('Content-Type: application/json; charset=utf-8');

$action = $_REQUEST['action'] ?? 'list';
$conn = DbConnection::getInstance()->getConnection();

try {
    if ($action === 'list') {
        $res = $conn->query("SELECT id, name, quantity, threshold, unit, unit_price, updated_at FROM ingredients ORDER BY name");
        $out = [];
        while ($r = $res->fetch_assoc()) $out[] = $r;
        echo json_encode(['ok'=>true,'data'=>$out]);
        exit;
    }

    if ($action === 'add') {
        $name = trim($_POST['name'] ?? '');
        $qty = floatval($_POST['quantity'] ?? 0);
        $threshold = floatval($_POST['threshold'] ?? 0);
        $unit = trim($_POST['unit'] ?? '');
        $unit_price = floatval($_POST['unit_price'] ?? 0.0);

        if ($name === '') throw new Exception('Nome obrigatório');

        $stmt = $conn->prepare("INSERT INTO ingredients (name, quantity, threshold, unit, unit_price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sddsd', $name, $qty, $threshold, $unit, $unit_price);
        $ok = $stmt->execute();
        $insertId = $stmt->insert_id;
        $stmt->close();

        if ($ok) {
            Logger::getInstance()->log('info', "Ingrediente criado: {$name}", ['ingredient_id'=>$insertId]);
            echo json_encode(['ok'=>true,'id'=>$insertId]);
        } else throw new Exception('Falha ao inserir ingrediente');
        exit;
    }

    if ($action === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $qty = floatval($_POST['quantity'] ?? 0);
        $threshold = floatval($_POST['threshold'] ?? 0);
        $unit = trim($_POST['unit'] ?? '');
        $unit_price = floatval($_POST['unit_price'] ?? 0.0);

        if ($id <= 0 || $name === '') throw new Exception('Parâmetros inválidos');

        $stmt = $conn->prepare("UPDATE ingredients SET name=?, quantity=?, threshold=?, unit=?, unit_price=?, updated_at=NOW() WHERE id=?");
        $stmt->bind_param('sddsdi', $name, $qty, $threshold, $unit, $unit_price, $id);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            Logger::getInstance()->log('info', "Ingrediente atualizado: {$name}", ['ingredient_id'=>$id]);
            echo json_encode(['ok'=>true]);
        } else throw new Exception('Falha ao atualizar ingrediente');
        exit;
    }

    if ($action === 'delete') {
        $id = intval($_POST['id'] ?? 0);
        if ($id <= 0) throw new Exception('ID inválido');
        $stmt = $conn->prepare("DELETE FROM ingredients WHERE id = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        if ($ok) {
            Logger::getInstance()->log('info', "Ingrediente removido (id={$id})", ['ingredient_id'=>$id]);
            echo json_encode(['ok'=>true]);
        } else throw new Exception('Falha ao remover ingrediente');
        exit;
    }

    http_response_code(400);
    echo json_encode(['ok'=>false,'msg'=>'Ação inválida']);
    exit;

} catch (Throwable $e) {
    Logger::getInstance()->log('error', 'stock_api error: ' . $e->getMessage(), ['action'=>$action, 'post'=>$_POST]);
    http_response_code(500);
    echo json_encode(['ok'=>false,'msg'=>$e->getMessage()]);
    exit;
}
