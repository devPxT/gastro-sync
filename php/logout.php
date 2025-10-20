<?php
// php/logout.php
session_start();

// limpa variáveis
$_SESSION = [];

// destrói cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// redireciona para login
header('Location: ../index.php');
exit;
