<?php

require_once 'Tabuada.php';
use Exercicio_12\Tabuada;

$resultTabuada = null;
$tabuadaArray;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
    $tabuadaArray = (new Tabuada($numero))->gerar();
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Tabuada com Classe</title>
</head>

<body>
    <div>
        <h1>Gerador de Tabuada com Classe</h1>
        <form action="index.php" method="post">
            <label for="numero">Número:</label>
            <input type="number" name="numero" id="numero" placeholder="Digite um número">
            <button type="submit">Calcular</button>
        </form>
    </div>
    <hr>
    <?php if (isset($tabuadaArray)): ?>
        <table>
            <thead>
                <tr>
                    <th colspan="5">Tabuada do <?= $numero ?></th>
                </tr>
            <tbody>
                <?php foreach ($tabuadaArray as $key => $resultado): ?>
                    <tr align="center">
                        <td><?= $numero ?></td>
                        <td> x </td>
                        <td><?= $key ?></td>
                        <td> = </td>
                        <td><?= $resultado ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>