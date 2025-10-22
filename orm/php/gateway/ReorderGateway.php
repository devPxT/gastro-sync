<?php
// php/gateway/ReorderGateway.php
require_once __DIR__ . '/../Database.php';

class ReorderGateway
{
    private \PDO $pdo;
    private string $table = 'tg_reorders';

    public function __construct(){ $this->pdo = Database::getConnection(); }

    public function findPending(): array
    {
        $stmt = $this->pdo->query("SELECT r.*, i.name AS ingredient_name FROM {$this->table} r JOIN ingredients i ON i.id = r.ingredient_id WHERE r.status <> 'received' ORDER BY r.created_at DESC");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function insert(int $ingredientId, float $qty, ?float $estimated = null, ?string $note = null): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (ingredient_id, quantity, estimated_total, note) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ingredientId, $qty, $estimated, $note]);
        return (int)$this->pdo->lastInsertId();
    }

    public function markReceived(int $id, float $receivedQty): bool
    {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("SELECT ingredient_id FROM {$this->table} WHERE id = ? FOR UPDATE");
            $stmt->execute([$id]);
            $row = $stmt->fetch();
            if (!$row) throw new Exception('Not found');

            $ingredientId = (int)$row['ingredient_id'];
            $u1 = $this->pdo->prepare("UPDATE ingredients SET quantity = quantity + ?, updated_at = NOW() WHERE id = ?");
            $u1->execute([$receivedQty, $ingredientId]);

            $u2 = $this->pdo->prepare("UPDATE {$this->table} SET status='received', received_at = NOW(), quantity = ? WHERE id = ?");
            $u2->execute([$receivedQty, $id]);

            $this->pdo->commit();
            return true;
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
