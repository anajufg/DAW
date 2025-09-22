<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $users = json_decode(file_get_contents("users.json"), true);
    $user = $_POST["username"];
    $pass = $_POST["password"];

    if (isset($users[$user]) && $users[$user]["password"] === $pass) {
        $_SESSION["user"] = $user;
        $_SESSION["indice"] = 0;
        $_SESSION["score"] = 0;
        header("Location: jogo.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Show do Bilhão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div>
            <div class="title">Login</div>
            <div class="subtitle">Entre para jogar</div>
        </div>
    </header>

    <main class="stage">
        <form method="post" class="form">
            <div class="question-text">Digite seus dados:</div>
            <?php if (!empty($erro)) echo "<p class='error'>$erro</p>"; ?>
            <input type="text" name="username" placeholder="Usuário" required><br><br>
            <input type="password" name="password" placeholder="Senha" required><br><br>
            <div class="button-group">
                <button type="submit" class="btn">Entrar</button>
                <a href="index.php" class="btn secondary">Voltar</a>
            </div>
        </form>
    </main>
</div>
</body>
</html>
