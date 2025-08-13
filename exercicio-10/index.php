<?php

require_once 'Compromisso.php';

use Exercicio_10\Compromisso;
if (!isset($_SESSION['compromissos'])) {
    $_SESSION['compromissos'] = [];
}

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty($_POST['data']) && !empty($_POST['horario']) && !empty($_POST['descricao'])
) {
    $data = filter_var(preg_replace("([^0-9-])", "", htmlentities($_POST['data'])));
    $horario = $_POST['horario'];
    if (strtotime($horario) !== false) {
        $horario = date('H:i:s', strtotime($horario));
    } else {
        $horario = null;
    }
    $descricao = htmlspecialchars($_POST['descricao'], ENT_QUOTES, 'UTF-8');

    $choqueCompromisso = false;
    foreach ($_SESSION['compromissos'] as $compromissoNaSessao) {
        if ($compromissoNaSessao->getData() === $data && $compromissoNaSessao->getHorario === $horario) {
            $choqueCompromisso = true;
            break;
        }
    }
    $compromisso = new Compromisso($data, $horario, $descricao);

}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Compromissos (com Sessão)</title>
</head>

<body>
    <h1>Agenda de Compromissos (com Sessão)</h1>
    <h2>Novo Compromisso</h2>
    <form action="index.php" method="post">
        <label for="data">Data:</label>
        <input type="date" name="data" id="data" required>
        <label for="horario">Horário:</label>
        <input type="time" name="horario" id="horario" required>
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" required>
        <button type="submit">Criar</button>
    </form>
</body>

</html>