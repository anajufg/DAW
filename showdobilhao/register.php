<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $users = json_decode(file_get_contents("users.json"), true) ?? [];

    $user = $_POST["username"];
    $pass = $_POST["password"];

    if (!isset($users[$user])) {
        $users[$user] = ["password" => $pass, "score" => 0];
        file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
        header("Location: login.php");
        exit;
    } else {
        $erro = "Usuário já existe!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Show do Bilhão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div>
            <div class="title">Cadastro</div>
            <div class="subtitle">Crie sua conta para jogar</div>
        </div>
    </header>

    <main class="stage">
        <form method="post" class="form">
            <div class="question-text">Preencha os campos:</div>
            <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
            <input type="text" name="username" placeholder="Usuário" required><br><br>
            <input type="password" name="password" placeholder="Senha" required><br><br>
            <div class="button-group">
                <button type="submit" class="btn">Cadastrar</button>
                <a href="index.php" class="btn secondary">Voltar</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
