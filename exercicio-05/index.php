<?php

$mensagem = '';
$resultado = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mensagem'])) {

    mb_internal_encoding("UTF-8");

    $mensagem = htmlspecialchars(
        $_POST['mensagem'],
        ENT_NOQUOTES,
        "UTF-8"
    );
    $resultado['com_espaco'] = mb_strlen($mensagem);
    $resultado['sem_espaco'] = mb_strlen(str_replace(
        ' ',
        '',
        $mensagem
    ));
    $mensagemLimpa = preg_replace('/[^\p{L}\p{N}\s]/u', '', $mensagem);

    $palavras = preg_split('/\s+/', trim($mensagemLimpa), -1, PREG_SPLIT_NO_EMPTY);

    $resultado['qtd_palavras'] = count($palavras);
    if (!empty($palavras)) {
        $resultado['primeira_palavra'] = $palavras[0];
        $resultado['ultima_palavra'] = $palavras[count($palavras) - 1];
    } else {
        $resultado['primeira_palavra'] = 'N/A';
        $resultado['ultima_palavra'] = 'N/A';
    }

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Caracteres e Palavras</title>
</head>

<body>
    <h1>Contador de Caracteres e Palavras</h1>
    <form action="index.php" method="post" id="contador">
        <div>
            <textarea name="mensagem" form="contador" rows="4" cols="60" placeholder="Digite sua mensagem."
                required></textarea>
        </div>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
<?php if (!empty($resultado)): ?>
    <hr>
    <h3>Resultados:</h3>
    <p>Quantidade de caracteres (com espaço): <strong><?= $resultado['com_espaco'] ?></strong></p>
    <p>Quantidade de caracteres (sem espaço): <strong><?= $resultado['sem_espaco'] ?></strong></p>
    <p>Quantidade de palavras: <strong><?= $resultado['qtd_palavras'] ?></strong></p>
    <p>Primeira palavra do texto: <strong><?= $resultado['primeira_palavra'] ?></strong></p>
    <p>Última palavra do texto: <strong><?= $resultado['ultima_palavra'] ?></strong></p>
<?php endif; ?>

</html>