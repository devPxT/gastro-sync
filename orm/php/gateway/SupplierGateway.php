<?php
// php/gateway/SupplierGateway.php
require_once __DIR__ . '/../Database.php';

class SupplierGateway
{
    private \PDO $pdo;
    private string $table = 'tg_suppliers';

    public function __construct(){ $this->pdo = Database::getConnection(); }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table} ORDER BY name");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $r = $stmt->fetch();
        return $r ?: null;
    }

    public function insert(array $data): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (name, contact, phone) VALUES (?, ?, ?)");
        $stmt->execute([$data['name'], $data['contact'] ?? null, $data['phone'] ?? null]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET name = ?, contact = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $data['contact'] ?? null, $data['phone'] ?? null, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
