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
  <div class="login" action="php/login.php" method="POST" id="loginForm">
    <input type="text" placeholder="Username">
    <input type="password" placeholder="Password">
    <button id="logar">Login</button>
  </div>
</body>
</html>