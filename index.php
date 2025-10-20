<?php
session_start();
$loginError = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']); // limpa erro após exibir

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="css/login.css">
  <script src="vendor/jquery/jquery-3.7.1.min.js"></script>
  <script src="js/login.js"></script>
</head>
<body>
  <form class="login" action="php/login.php" method="POST" id="loginForm">
    <input type="text" placeholder="Username" name="username" required>
    <input type="password" placeholder="Password" name="password" required>
    <button id="logar">Login</button>
  </form>

  <?php if ($loginError): ?>
    <script>
      $(function() {
        showAlert("<?= htmlspecialchars($loginError) ?>");
      });
    </script>
  <?php endif; ?>
</body>
</html>