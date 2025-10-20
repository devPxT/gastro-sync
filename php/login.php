<?php
// php/login.php
require_once __DIR__ . '/bootstrap.php'; // autoload + registro
require_once __DIR__ . '/classes/DbConnection.php';
require_once __DIR__ . '/classes/Logger.php';

// Segurança: configurar cookie params antes de session_start
session_set_cookie_params([
    'lifetime' => 0,            // até fechar o navegador
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax'
    // 'secure' => true // ative se usar HTTPS
]);

session_start();

function redirect_with_error($msg = null) {
    // você pode mostrar error via GET param ou flash session
    if ($msg) $_SESSION['login_error'] = $msg;
    header('Location: ../index.php');
    exit;
}

// pegar POST
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$username = trim($username);
$password = trim($password);

if ($username === '' || $password === '') {
    redirect_with_error('Usuário ou senha vazios.');
}

$conn = DbConnection::getInstance()->getConnection();
$stmt = $conn->prepare("SELECT id, login, password FROM users WHERE login = ? LIMIT 1");
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();
$stmt->close();

if (! $user) {
    // usuário não encontrado
    Logger::getInstance()->log('warning', "Tentativa de login inválida: usuário {$username}");
    redirect_with_error('Usuário ou senha inválidos.');
}

// assumimos que password no DB está com hash (password_hash)
// $hash = $user['password'];

// if (password_verify($password, $hash)) {
if ($user['password'] === $password) {
    // sucesso: regenerar id de sessão e gravar dados
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['username'] = $user['login'];
    // limpar possíveis erros antigos
    unset($_SESSION['login_error']);

    Logger::getInstance()->log('info', "Usuário logou: {$user['login']}", ['user_id' => $user['id']]);

    header('Location: ../home.php');
    exit;
} else {
    Logger::getInstance()->log('warning', "Senha incorreta para usuário {$username}");
    redirect_with_error('Usuário ou senha inválidos.');
}

/*
Se o seu banco tiver senhas em texto puro (NÃO RECOMENDADO), use:
if ($user['password'] === $password) { ... }
mas converta para hash o quanto antes.
*/
