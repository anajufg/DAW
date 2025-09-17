<?php
require_once 'inc/perguntas.inc';
if (session_status() == PHP_SESSION_NONE) session_start();

if (empty(\$_SESSION['user'])) {
header('Location: login.php');
exit;
}

$total = totalPerguntas();

if (\$_SERVER['REQUEST_METHOD'] === 'POST') {
\$id = isset(\$_POST['id']) ? intval(\$_POST['id']) : 0;
\$selected = isset(
\$_POST['alternativa']) ? intval(\$_POST['alternativa']) : -1;
\$q = carregaPergunta(\$id);
if (!\$q) { header('Location: index.php'); exit; }
if (\$selected === intval(\$q['resposta'])) {
\$_SESSION['score'] = (\$_SESSION['score'] ?? 0) + 1;
\$next = \$id + 1;
if (\$next >= \$total) {
setcookie('last_play', date('d/m/Y H:i:s'), time()+60*60*24*365);
setcookie('last_score', \$_SESSION['score'], time()+60*60*24*365);
header('Location: gameover.php');
exit;
}
header('Location: perguntas.php?id=' . \$next);
exit;
} else {
setcookie('last_play', date('d/m/Y H:i:s'), time()+60*60*24*365);
setcookie('last_score', \$_SESSION['score'], time()+60*60*24*365);
header('Location: gameover.php');
exit;
}
}

\$id = isset(\$_GET['id']) ? intval(\$_GET['id']) : 0;
\$q = carregaPergunta(\$id);
if (!\$q) {
echo "Pergunta não encontrada."; exit;
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Pergunta <?=\$id+1?></title></head>
<body>
<?php include 'inc/menu.inc'; ?>
<main>
<h2>Pergunta <?=(\$id+1)?> de <?=\$total?></h2>
<p><?=htmlspecialchars(\$q['enunciado'])?></p>
<form method="post">
<?php foreach (\$q['alternativas'] as \$i => \$alt): ?>
<label>
<input type="radio" name="alternativa" value="<?=\$i?>"> <?=htmlspecialchars(\$alt)?>
</label><br>
<?php endforeach; ?>
<input type="hidden" name="id" value="<?=\$id?>">
<p>Acertos até agora: <?=(\$_SESSION['score'] ?? 0)?></p>
<button>Responder</button>
</form>
</main>
<?php include 'inc/rodape.inc'; ?>
</body></html>