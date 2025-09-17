<?php
require_once 'classes/User.php';
if (session_status() == PHP_SESSION_NONE) session_start();
\$error = '';
if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
\$nome = trim(\$_POST['nome']);
\$email = trim(\$_POST['email']);
\$login = trim(\$_POST['login']);
\$senha = \$_POST['senha'];
if (!\$nome || !\$email || !\$login || !\$senha) {
\$error = 'Preencha todos os campos.';
} else {
if (User::findByLogin(\$login)) {
\$error = 'Login já existe.';
} else {
\$hash = password_hash(\$senha, PASSWORD_DEFAULT);
User::saveUser(['nome'=>\$nome,'email'=>\$email,'login'=>\$login,'senha'=>\$hash]);
header('Location: login.php');
exit;
}
}
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Cadastro</title></head>
<body>
<?php include 'inc/menu.inc'; ?>
<h2>Cadastro</h2>
<?php if (\$error): ?><p style="color:red;"><?=htmlspecialchars(\$error)?></p><?php endif; ?>
<form method="post">
<label>Nome: <input name="nome"></label><br>
<label>Email: <input name="email"></label><br>
<label>Login: <input name="login"></label><br>
<label>Senha: <input type="password" name="senha"></label><br>
<button>Registrar</button>
</form>
<?php include 'inc/rodape.inc'; ?>
</body></html>