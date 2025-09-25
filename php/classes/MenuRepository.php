<?php
// php/classes/MenuRepository.php
require_once __DIR__ . '/DbConnection.php';
require_once __DIR__ . '/MenuFactory.php'; // usa sua MenuFactory (FactoryMethod)
require_once __DIR__ . '/MenuItem.php';

class MenuRepository
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getInstance()->getConnection();
    }

    /**
     * Retorna um array de itens do menu.
     * Cada elemento: ['entity' => MenuItem, 'db' => assoc_row_from_db]
     *
     * @return array
     */
    public function all(): array
    {
        $sql = "SELECT * FROM menu_items ORDER BY type, name";
        $res = $this->conn->query($sql);
        if (!$res) {
            // opcional: lançar exceção ou retornar array vazio
            return [];
        }

        $out = [];
        while ($r = $res->fetch_assoc()) {
            // meta é um JSON opcional com propriedades extras (size, alcoholic, sweetness, etc)
            $meta = [];
            if (!empty($r['meta'])) {
                $decoded = json_decode($r['meta'], true);
                if (is_array($decoded)) $meta = $decoded;
            }

            $data = array_merge(['name' => $r['name'], 'price' => (float)$r['price']], $meta);

            try {
                // delega para a MenuFactory que fará create('dish'|'drink'|'dessert'...)
                $item = MenuFactory::create($r['type'], $data);
            } catch (Throwable $e) {
                // fallback: criar um MenuItem simples (Dish) ou pular
                $item = new class($r['name'], (float)$r['price']) extends MenuItem {
                    public function getDescription(): string {
                        return "{$this->name} - R$ " . number_format($this->price, 2, ',', '.');
                    }
                };
            }

            $out[] = ['entity' => $item, 'db' => $r];
        }

        return $out;
    }

    /**
     * Busca um item por id 
     */
    public function find(int $id): ?array
    {
        $id = (int)$id;
        $res = $this->conn->query("SELECT * FROM menu_items WHERE id = {$id} LIMIT 1");
        if (!$res || $res->num_rows === 0) return null;
        $r = $res->fetch_assoc();
        $meta = json_decode($r['meta'] ?? '{}', true) ?: [];
        $data = array_merge(['name' => $r['name'], 'price' => (float)$r['price']], $meta);

        try {
            $item = MenuFactory::create($r['type'], $data);
        } catch (Throwable $e) {
            $item = null;
        }

        return $item ? ['entity' => $item, 'db' => $r] : null;
    }
}
