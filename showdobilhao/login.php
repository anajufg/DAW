<?php
require_once 'classes/User.php';
if (session_status() == PHP_SESSION_NONE) session_start();
\$error = '';
if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
\$login = trim(\$_POST['login']);
\$senha = \$_POST['senha'];
\$user = User::findByLogin(\$login);
if (!\$user || !password_verify(\$senha, \$user['senha'])) {
\$error = 'Login ou senha incorretos.';
} else {
\$_SESSION['user'] = \$user;
\$_SESSION['score'] = 0;
header('Location: index.php');
exit;
}
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Login</title></head>
<body>
<?php include 'inc/menu.inc'; ?>
<h2>Login</h2>
<?php if (\$error): ?><p style="color:red;"><?=htmlspecialchars(\$error)?></p><?php endif; ?>
<form method="post">
<label>Login: <input name="login"></label><br>
<label>Senha: <input type="password" name="senha"></label><br>
<button>Entrar</button>
</form>
<?php include 'inc/rodape.inc'; ?>
</body></html>