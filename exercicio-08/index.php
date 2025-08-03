<?php
require_once 'Temperatura.php';
use Exercicio_08\Temperatura;

$resultadoFinal = null;
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['valor'])
    && !empty($_POST['conversao'])
) {
    $valor = (int) filter_input(
        INPUT_POST,
        'valor',
        FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION
    );
    $conversao = htmlspecialchars($_POST['conversao']);

    $temperatura = new Temperatura($valor);
    $valorConvertido = 0;

    if ($conversao === 'C_para_F') {
        $valorConvertido = $temperatura->celsiusParaFahrenheit();
        $resultadoFinal = "{$valor}°C equivale a " . number_format($valorConvertido, 1, ',', '') . "°F";
    } elseif ($conversao === 'F_para_C') {
        $valorConvertido = $temperatura->fahrenheitParaCelsius();
        $resultadoFinal = "{$valor}°F equivale a " . number_format($valorConvertido, 1, ',', '') . "°C";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Temperatura com Classe</title>
</head>

<body>
    <h1>Conversor de Temperatura com Classe</h1>
    <form action="index.php" method="post">
        <label for="valor">Temperatura:</label>
        <input type="number" id="valor" name="valor" placeholder="Temperatura" required>
        <label for="conversao">Converter para:</label>
        <select name="conversao" id="conversao" required>
            <option value="" disabled selected>--- Selecione a converão ---</option>
            <option value="C_para_F">Celsius para Fahrenheit</option>
            <option value="F_para_C">Fahrenheit para Celsius</option>
        </select>
        <button type="submit">Converter</button>
    </form>

    <?php if ($resultadoFinal): ?>
        <hr>
        <p><strong>Resultado:</strong> <?= $resultadoFinal ?></p>
    <?php endif; ?>
</body>

</html>