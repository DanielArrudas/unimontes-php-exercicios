<?php

require_once 'Pessoa.php';

use Exercicio_06\Pessoa;

$resultado = [];
$pessoa = null;
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty($_POST['nome'])
    && !empty($_POST['peso'])
    && !empty($_POST['altura'])
) {
    $nome = htmlspecialchars(
        $_POST['nome'],
        ENT_QUOTES,
        'UTF-8'
    );

    $peso = (float) filter_input(
        INPUT_POST,
        'peso',
        FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION
    );

    $altura = (float) filter_input(
        INPUT_POST,
        'altura',
        FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION
    );
    $pessoa = new Pessoa($nome, $peso, $altura);

    $resultado['imc'] = $pessoa->calculaIMC();

    $resultado['classificacao'] = $pessoa->getClassificacaoIMC();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC (Índice de Massa Corporal)</title>
</head>

<body>
    <h1>Calculadora de IMC (Índice de Massa Corporal)</h1>
    <form action="index.php" method="post">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" placeholder="João da Silva" required>
        <label for="peso">Peso em kg:</label>
        <input type="number" name="peso" id="peso" placeholder="70,50" step=".01" min="1" required>
        <label for="altura">Altura:</label>
        <input type="number" name="altura" id="altura" placeholder="1,70" step=".01" min="1" required>
        <button type="submit">Calcular</button>
    </form>
</body>
<?php if ($resultado): ?>

    <hr>
    <h3>Resultado:</h3>
    <p>Nome: <?= $pessoa->getNome(); ?></p>
    <p>IMC: <?= number_format($resultado['imc'], 2, ',', '.'); ?></p>
    <p>Classificação: <?= $resultado['classificacao']; ?></p>

<?php endif; ?>

</html>