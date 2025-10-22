<?php
// php/mapper/InvoiceLineMapper.php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/InvoiceLine.php';

class InvoiceLineMapper
{
    private \PDO $pdo;
    public function __construct(){ $this->pdo = Database::getConnection(); }

    public function insertForInvoice(int $invoiceId, InvoiceLine $line): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO dm_invoice_lines (invoice_id, description, qty, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$invoiceId, $line->description, $line->qty, $line->price]);
        return (int)$this->pdo->lastInsertId();
    }

    public function findByInvoice(int $invoiceId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM dm_invoice_lines WHERE invoice_id = ?");
        $stmt->execute([$invoiceId]);
        $rows = $stmt->fetchAll();
        $out = [];
        foreach ($rows as $r) {
            $ln = new InvoiceLine((int)$r['id'], $r['description'], (int)$r['qty'], (float)$r['price']);
            $ln->invoice_id = (int)$r['invoice_id'];
            $out[] = $ln;
        }
        return $out;
    }
}
