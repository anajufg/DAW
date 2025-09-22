<?php
session_start();

$users = json_decode(file_get_contents("users.json"), true) ?? [];

if (isset($_SESSION["user"])) {
    $users[$_SESSION["user"]]["score"] = max($users[$_SESSION["user"]]["score"], $_SESSION["score"]);
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
    session_destroy();
}

usort($users, function($a, $b) {
    return $b["score"] <=> $a["score"];
});
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ranking - Show do Bilhão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div>
            <div class="title">Ranking</div>
            <div class="subtitle">Melhores jogadores</div>
        </div>
    </header>

    <main class="stage">
        <div class="question-wrap">
            <div class="question-card">
                <div class="question-text">Placar Geral</div>
                <table class="ranking-table">
                    <tr><th>Jogador</th><th>Pontuação</th></tr>
                    <?php foreach ($users as $nome => $dados): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($nome); ?></td>
                            <td>R$ <?php echo number_format($dados["score"], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                </div>
                <a href="index.php" class="btn">Voltar ao Início</a>
            </div>
    </main>
</div>
</body>
</html>
