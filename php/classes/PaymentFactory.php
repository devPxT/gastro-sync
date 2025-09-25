<?php
// php/classes/PaymentFactory.php

class PaymentFactory
{
    /** @var array<string, callable> */
    private static array $registry = [];

    public static function register(string $method, callable $creator): void
    {
        self::$registry[$method] = $creator;
    }

    public static function create(string $method, array $options = []): PaymentStrategyInterface
    {
        if (!isset(self::$registry[$method])) {
            throw new InvalidArgumentException("Método de pagamento não registrado: {$method}");
        }
        $creator = self::$registry[$method];
        $inst = $creator($options);
        if (!$inst instanceof PaymentStrategyInterface) {
            throw new RuntimeException("Creator para {$method} não retornou PaymentStrategyInterface");
        }
        return $inst;
    }

    public static function availableMethods(): array
    {
        return array_keys(self::$registry);
    }
}
