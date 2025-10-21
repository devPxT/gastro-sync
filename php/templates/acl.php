<?php
// php/templates/acl.php
require_once __DIR__ . '/../classes/Permissions.php';

function requirePermissionOrRedirect(int $userId, string $permissionCode) {
    $perm = new Permissions();
    if (! $perm->userHasPermission($userId, $permissionCode)) {
        // set flash message and redirect to home
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['flash_alert'] = "Você não tem permissão para acessar essa seção.";
        header('Location: ./home.php');
        exit;
    }
}
