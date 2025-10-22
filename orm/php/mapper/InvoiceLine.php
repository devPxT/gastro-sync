<?php
// php/mapper/InvoiceLine.php
class InvoiceLine
{
    public ?int $id;
    public ?int $invoice_id;
    public string $description;
    public int $qty;
    public float $price;

    public function __construct(?int $id = null, string $description = '', int $qty = 1, float $price = 0.0)
    {
        $this->id = $id;
        $this->description = $description;
        $this->qty = $qty;
        $this->price = $price;
    }
}
