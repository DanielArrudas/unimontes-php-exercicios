<?php

const COTACAO = [
    'dolar' => 5.54,
    'euro' => 6.42,
    'libra' => 7.34
];

function ConverteMoeda(string $moeda, float $valor): float
{
    return match ($moeda) {
        'dolar' => $valor / COTACAO['dolar'],
        'euro' => $valor / COTACAO['euro'],
        'libra' => $valor / COTACAO['libra'],
        default => 0.0
    };
}

function PrintaConversao(string $moeda, float $valor, float $valorConvertido)
{
    $valorEmReais = "R$ " . number_format($valor, 2, ',', '.');
    $valorFinal = match ($moeda) {
        'dolar' => '$' . number_format($valorConvertido, 2, '.', ','),
        'euro' => number_format($valorConvertido, 2, ',', '.') . ' €',
        'libra' => '£' . number_format($valorConvertido, 2, '.', ','),
        default => ''
    };
    return "{$valorEmReais} equivale a {$valorFinal}";
}

$resultado = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['valor']) && !empty($_POST['moeda'])) {
    $valor = (float) filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $moeda = htmlspecialchars($_POST['moeda'], ENT_QUOTES, 'UTF-8');
    if ($valor > 0) {
        $valorConvertido = ConverteMoeda($moeda, $valor);
        $resultado = PrintaConversao($moeda, $valor, $valorConvertido);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conversor de Moedas</title>
</head>

<body>
    <h1>Conversor de Moedas</h1>
    <form action="index.php" method="post">
        <label for="valor">Insira o valor em reais:</label>
        <input type="number" placeholder="00.00" min="0.01" step=".01" name="valor" id="valor" required>
        <select name="moeda" required>
            <option value="" disabled selected>--- Moeda para conversão ---:</option>
            <option value="dolar">Dólar</option>
            <option value="euro">Euro</option>
            <option value="libra">Libra</option>
        </select>
        <button type="submit">Converter</button>
    </form>
        <?php if ($resultado): ?>
        <hr>
        <p><?=$resultado?></p>
        <?php endif; ?>
</body>

</html>