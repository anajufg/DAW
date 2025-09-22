<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Show do Bilhão</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">

    <header class="header">
        <div>
            <div class="title main">Show do Bilhão</div>
        </div>
    </header>

    <main class="stage">
        <div class="question-text">Bem-vindo ao Show do Bilhão!</div>
        <div class="button-group">
            <a href="login.php" class="btn">Entrar</a>
            <a href="register.php" class="btn secondary">Cadastrar</a>
        </div>
    </main>
</div>
</body>
</html>
