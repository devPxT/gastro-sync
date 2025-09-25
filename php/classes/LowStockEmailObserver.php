<?php
// php/classes/LowStockEmailObserver.php
require_once __DIR__ . '/ObserverInterface.php';
require_once __DIR__ . '/Logger.php';

class LowStockEmailObserver implements ObserverInterface
{
    private array $recipients;

    public function __construct(array $recipients = [])
    {
        $this->recipients = $recipients;
    }

    public function update(InventorySubject $subject, array $ingredient): void
    {
        // aqui você integraria com mailer real. No exemplo, apenas grava log como "email enviado".
        $subjectLine = "Alerta de estoque baixo: {$ingredient['name']}";
        $message = "Ingrediente {$ingredient['name']} está em {$ingredient['quantity']} {$ingredient['unit']} (limite {$ingredient['threshold']}).";

        foreach ($this->recipients as $to) {
            Logger::getInstance()->log('info', "Simulando envio de email para {$to}: {$subjectLine}", ['to'=>$to,'message'=>$message,'ingredient'=>$ingredient]);
            // em produção: mail($to,$subjectLine,$message) ou usar biblioteca
        }
    }
}
