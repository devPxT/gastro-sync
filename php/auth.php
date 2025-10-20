<?php
// php/auth.php
// garante sessão e usuário logado, caso contrário redireciona para index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    // opcional: salvar a URL pedida para retorno após login
    $_SESSION['after_login_redirect'] = $_SERVER['REQUEST_URI'];
    header('Location: index.php');
    exit;
}

// você pode expor o usuário atual em variáveis
$CURRENT_USER_ID = $_SESSION['user_id'];
$CURRENT_USERNAME = $_SESSION['username'] ?? null;
