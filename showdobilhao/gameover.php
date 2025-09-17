<?php
if (session_status() == PHP_SESSION_NONE) session_start();
\$score = \$_SESSION['score'] ?? 0;

?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Game Over</title></head>
<body>
<?php include 'inc/menu.inc'; ?>
<main>
<h2>Game Over</h2>
<p>Sua pontuação final: <?=htmlspecialchars(\$score)?></p>
<p><a href="question.php?id=0">Jogar novamente</a></p>
<p><a href="logout.php">Sair</a></p>
</main>
<?php include 'inc/rodape.inc'; ?>
</body></html>