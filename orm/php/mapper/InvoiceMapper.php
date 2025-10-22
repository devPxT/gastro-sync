<?php
// php/mapper/InvoiceMapper.php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/Invoice.php';
require_once __DIR__ . '/InvoiceLineMapper.php';

class InvoiceMapper
{
    private \PDO $pdo;
    private InvoiceLineMapper $lineMapper;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->lineMapper = new InvoiceLineMapper();
    }

    public function save(Invoice $invoice): bool
    {
        if ($invoice->id) {
            // update main invoice (only customer here)
            $stmt = $this->pdo->prepare("UPDATE dm_invoices SET customer = ? WHERE id = ?");
            $stmt->execute([$invoice->customer, $invoice->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO dm_invoices (customer, created_at) VALUES (?, NOW())");
            $stmt->execute([$invoice->customer]);
            $invoice->id = (int)$this->pdo->lastInsertId();
        }

        // save lines: simple approach - delete existing lines then insert current (or use UoW)
        $this->pdo->prepare("DELETE FROM dm_invoice_lines WHERE invoice_id = ?")->execute([$invoice->id]);
        foreach ($invoice->lines as $ln) {
            $this->lineMapper->insertForInvoice($invoice->id, $ln);
        }

        return true;
    }

    public function find(int $id): ?Invoice
    {
        $stmt = $this->pdo->prepare("SELECT * FROM dm_invoices WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        $inv = new Invoice((int)$row['id'], $row['customer']);
        $inv->createdAt = new DateTime($row['created_at']);
        $inv->lines = $this->lineMapper->findByInvoice($inv->id);
        return $inv;
    }
}
