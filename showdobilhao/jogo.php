<?php
session_start();

$perguntas = json_decode(file_get_contents("perguntas.json"), true);

if (!isset($_SESSION['indice'])) {
    $_SESSION['indice'] = 0;
    $_SESSION['score'] = 0;
}
$indice = $_SESSION['indice'];

if ($indice >= count($perguntas)) {
    header("Location: ranking.php");
    exit;
}

$pergunta = $perguntas[$indice];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resposta = $_POST["resposta"] ?? null;

    if ($resposta === $pergunta["correta"]) {
        $_SESSION['score'] += 1000; 
        $_SESSION['indice']++;
        $respostaCerta = true;
    } else {
        $respostaCerta = false;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Show do Bilhão</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

    <header class="header">
        <div class="title">Show do Bilhão</div>
    </header>

    <main class="stage">
        <div class="question-wrap">
            <form method="post" class="form">
                <div class="question-top">
                    <div class="question-number">
                        Pergunta <?php echo $indice + 1; ?> de <?php echo count($perguntas); ?>
                    </div>
                </div>
                <div class="question-text">
                    <?php echo htmlspecialchars($pergunta["pergunta"]); ?>
                </div>

                <div class="options">
                    <?php
                    $letras = ["a" => "A", "b" => "B", "c" => "C", "d" => "D"];
                    foreach ($pergunta["alternativas"] as $letra => $texto) {
                        echo "
                        <label class='option ".(isset($respostaCerta) ? ($letra === $pergunta["correta"] ? "correct" : ($letra === $resposta ? "incorrect" : "")) : "")."'>
                            <input type='radio' name='resposta' value='{$letra}' style='display:none;'>
                            <div class='label'>{$letras[$letra]}</div>
                            <div class='text'>".htmlspecialchars($texto)."</div>
                        </label>";
                    }
                    ?>
                </div>
            
                <?php
                if (isset($respostaCerta) && $respostaCerta) {
                    echo "<button type='button' onclick=\"window.location='jogo.php?next=1'\" class='btn'>Próxima</button>";
                } else {
                    echo "<button type='submit' class='btn'>Confirmar</button>";
                }
                ?>
            </form>
        </div>

        <aside class="sidebar">
            <div class="panel score">
                <span class="label">Prêmio Atual:</span>
                <span class="value">R$ <?php echo number_format($_SESSION['score'], 0, ',', '.'); ?></span>
            </div>
        </aside>
    </main>
</div>
</body>
</html>
