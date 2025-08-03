<?php

function PrintaMedia($media): string
{
    return match (true) {
        $media >= 6 => "Aluno aprovado.",
        $media < 4 => "Aluno reprovado.",
        default => "Aluno em recuperação.",
    };
}

$media = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nota1']) && !empty($_POST['nota2']) && !empty($_POST['nota3'])) {
    $nota1 = (float) filter_input(INPUT_POST, 'nota1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $nota2 = (float) filter_input(INPUT_POST, 'nota2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $nota3 = (float) filter_input(INPUT_POST, 'nota3', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $media = ($nota1 + $nota2 + $nota3) / 3;
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisador de Notas</title>
</head>

<body>
    <h1>Analisador de Notas</h1>
    <form action="index.php" method="post">
        <label for="nota1">Primeira nota:</label>
        <input type="number" name="nota1" id="nota1" placeholder="Primeira nota" min="0.00" step=".01" required>
        <label for="nota2">Segunda nota:</label>
        <input type="number" name="nota2" id="nota2" placeholder="Segunda nota" min="0.00" step=".01" required>
        <label for="nota3">Terceira nota:</label>
        <input type="number" name="nota3" id="nota3" placeholder="Terceira nota" min="0.00" step=".01" required>
        <button type="submit">Calcular nota</button>
    </form>

    <?php if ($media !== null): ?>
        <hr>
        <?php
        $mediaFormatada = number_format($media, 2, ',', '.');
        ?>
        <?= "A média do aluno é {$mediaFormatada}"; ?>
        <br>
        <?= PrintaMedia($mediaFormatada); ?>
    <?php endif; ?>

</body>

</html>