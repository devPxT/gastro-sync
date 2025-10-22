<?php
// php/mapper/Invoice.php
class Invoice
{
    public ?int $id;
    public string $customer;
    public \DateTime $createdAt;
    /** @var InvoiceLine[] */
    public array $lines = [];

    public function __construct(?int $id = null, string $customer = '')
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->createdAt = new DateTime();
    }

    public function addLine(InvoiceLine $line) { $this->lines[] = $line; }
    public function total(): float {
        $sum = 0.0;
        foreach ($this->lines as $l) $sum += $l->qty * $l->price;
        return $sum;
    }
}
