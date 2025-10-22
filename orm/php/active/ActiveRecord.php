<?php
// php/active/ActiveRecord.php
require_once __DIR__ . '/../Database.php';

abstract class ActiveRecord
{
    protected static string $table;
    protected array $attributes = [];
    protected ?int $id = null;

    public function __construct(array $attrs = [])
    {
        $this->attributes = $attrs;
        if (isset($attrs['id'])) $this->id = (int)$attrs['id'];
    }

    public function __get($name) { return $this->attributes[$name] ?? null; }
    public function __set($name, $value) { $this->attributes[$name] = $value; }

    public function save(): bool
    {
        $pdo = Database::getConnection();
        if ($this->id) {
            $cols = array_keys($this->attributes);
            $pairs = [];
            $values = [];
            foreach ($cols as $c) {
                if ($c === 'id') continue;
                $pairs[] = "`$c` = ?";
                $values[] = $this->attributes[$c];
            }
            $values[] = $this->id;
            $sql = "UPDATE " . static::$table . " SET " . implode(',', $pairs) . " WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute($values);
        } else {
            $cols = array_keys($this->attributes);
            $placeholders = array_fill(0, count($cols), '?');
            $sql = "INSERT INTO " . static::$table . " (`" . implode('`,`', $cols) . "`) VALUES (" . implode(',', $placeholders) . ")";
            $stmt = $pdo->prepare($sql);
            $ok = $stmt->execute(array_values($this->attributes));
            if ($ok) $this->id = (int)$pdo->lastInsertId();
            return $ok;
        }
    }

    public function delete(): bool
    {
        if (!$this->id) return false;
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM " . static::$table . " WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public static function find(int $id): ?self
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) return null;
        return new static($row);
    }

    public static function findAll(array $where = []): array
    {
        $pdo = Database::getConnection();
        if (empty($where)) {
            $stmt = $pdo->query("SELECT * FROM " . static::$table);
            $rows = $stmt->fetchAll();
        } else {
            $conds = [];
            $vals = [];
            foreach ($where as $k => $v) { $conds[] = "`$k` = ?"; $vals[] = $v; }
            $sql = "SELECT * FROM " . static::$table . " WHERE " . implode(' AND ', $conds);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($vals);
            $rows = $stmt->fetchAll();
        }
        $objs = [];
        foreach ($rows as $r) $objs[] = new static($r);
        return $objs;
    }
}
