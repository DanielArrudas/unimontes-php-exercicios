<?php

$firstValue = '';
$secondValue = '';
$operator = null;
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstValue = filter_input(INPUT_POST, "firstValue", FILTER_SANITIZE_NUMBER_FLOAT);
    $secondValue = filter_input(INPUT_POST, "secondValue", FILTER_SANITIZE_NUMBER_FLOAT);
    $operator = filter_has_var(INPUT_POST, "operator") ? htmlspecialchars($_POST["operator"]) : null;
    $firstValue = (int) $firstValue;
    $secondValue = (int) $secondValue;
    if($firstValue !== false && $secondValue !== false && !empty($operator)) {
        $value = 0;
        $value = match($operator){
            'add' => $firstValue + $secondValue,
            'subtract' => $firstValue - $secondValue,
            'multiply' => $firstValue * $secondValue,
            'divide' => $secondValue === 0 ? "<p>Error: Divisão por zero!</p>" : ($firstValue / $secondValue),
            default => 'Error: Operador invalido.',
        };
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Aritmética Simples</title>
</head>

<body>
    <h1>Calculadora Aritmética Simples</h1>
    <form action="index.php" method="post" id="calculator">
        <input type="number" name="firstValue" placeholder="Digite o primeiro valor" required>
        <select name="operator" id="operator" form="calculator" required>
            <option value="" disabled selected>--- Escolha um operador ---</option>
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="secondValue" placeholder="Digite o segundo valor" required>
        <button type="submit">Calculate</button>
        <?php
        if(isset($value)){
            if(is_string($value)) {
                echo $value;
                return;
            }
            echo "<p> Resultado = " . htmlspecialchars($value) . "</p>";
            return;
        }
        ?>
        
    </form>
</body>

</html>