<?php
// php/classes/Permissions.php
require_once __DIR__ . '/DbConnection.php';

class Permissions
{
    private mysqli $conn;

    public function __construct()
    {
        $this->conn = DbConnection::getInstance()->getConnection();
    }

    /** retorna array de codes das permissões do usuário */
    public function getUserPermissionCodes(int $userId): array
    {
        $sql = "
          SELECT p.code
          FROM permissions p
          JOIN role_permissions rp ON rp.permission_id = p.id
          JOIN users_roles ur ON ur.role_id = rp.role_id
          WHERE ur.user_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = [];
        while ($row = $res->fetch_assoc()) $out[] = $row['code'];
        $stmt->close();
        // unique
        return array_values(array_unique($out));
    }

    public function userHasPermission(int $userId, string $code): bool
    {
        $stmt = $this->conn->prepare("
            SELECT 1 FROM permissions p
            JOIN role_permissions rp ON rp.permission_id = p.id
            JOIN users_roles ur ON ur.role_id = rp.role_id
            WHERE ur.user_id = ? AND p.code = ? LIMIT 1
        ");
        $stmt->bind_param('is', $userId, $code);
        $stmt->execute();
        $res = $stmt->get_result();
        $has = ($res->num_rows > 0);
        $stmt->close();
        return $has;
    }

    public function getUserRoleNames(int $userId): array
    {
        $stmt = $this->conn->prepare("SELECT r.name FROM roles r JOIN users_roles ur ON ur.role_id=r.id WHERE ur.user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        $out = [];
        while ($r = $res->fetch_assoc()) $out[] = $r['name'];
        $stmt->close();
        return $out;
    }
}
