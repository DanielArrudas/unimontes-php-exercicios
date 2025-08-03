<?php

function PrintNameAndAge(): string
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome']) && !empty($_POST['data_nascimento'])) {
        $nome = $_POST['nome'];
        $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
        $data_nascimento = DateTime::createFromFormat('Y-m-d', $_POST['data_nascimento'])
            ->diff(new DateTime('now'))
            ->y;
        $statusIdade = $data_nascimento < 18 ? 'menor de idade.' : 'maior de idade.';

        return "{$nome} tem {$data_nascimento} anos e é {$statusIdade}";
    }
    return '';
}
$resultado = PrintNameAndAge();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Idade</title>
</head>

<body>
    <form action="index.php" method="post">


        <div>
            <label for="nome">Nome:</label>
            <input type="text" placeholder="Digite seu nome" name="nome" required>
        </div>
        <br>
        <div>
            <label for="data_nascimento">Ano de Nascimento:</label>
            <input type="date" name="data_nascimento" max="<?= date("Y-m-d") ?>" required>
        </div>
        <br>
        <div>
            <button type="submit">Enviar</button>
        </div>
        <br>
        <p>
            <?php
            if (!empty($resultado)) {
                echo "<hr>";
                echo "<p>{$resultado}</p>";
            }
            ?>
        </p>
    </form>
</body>

</html>