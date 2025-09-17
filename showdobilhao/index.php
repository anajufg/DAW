<?php
session_start();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Show do Bilhão</title></head>
<body>
<?php include 'inc/menu.inc'; ?>
<main>
<h1>Bem-vindo ao Show do Bilhão</h1>
<?php if (!empty(\$_COOKIE['last_play'])): ?>
<p>Última vez que você jogou: <?=htmlspecialchars(\$_COOKIE['last_play'])?></p>
<?php endif; ?>
<?php if (!empty(\$_COOKIE['last_score'])): ?>
<p>Sua última pontuação: <?=htmlspecialchars(\$_COOKIE['last_score'])?></p>
<?php endif; ?>


<?php if (!empty(\$_SESSION['user'])): ?>
<p>Olá, <?=htmlspecialchars(\$_SESSION['user']['nome'])?>! <a href="questions.php?id=0">Começar jogo</a></p>
<?php else: ?>
<p><a href="login.php">Faça o login</a> ou <a href="register.php">cadastre-se</a> para jogar.</p>
<?php endif; ?>
</main>
<?php include 'inc/rodape.inc'; ?>
</body>
</html>