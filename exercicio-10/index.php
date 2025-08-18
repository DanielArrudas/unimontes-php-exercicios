<?php

require_once 'Compromisso.php';

use Exercicio_10\Compromisso;
session_start();
if (!isset($_SESSION['compromissos'])) {
    $_SESSION['compromissos'] = [];
}

function compareCompromissosByDateTime(Compromisso $a, Compromisso $b): int
{
    if ($a->getDateTime() == $b->getDateTime()) {
        return 0;
    }
    return ($a->getDateTime() < $b->getDateTime()) ? -1 : 1;
}
$mensagemResultado = null;
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty($_POST['data']) && !empty($_POST['horario']) && !empty($_POST['descricao'])
) {
    $dataInput = $_POST['data'];
    $horarioInput = $_POST['horario'];

    $dateTimeObj = DateTime::createFromFormat('Y-m-d H:i', "{$dataInput} {$horarioInput}");

    if ($dateTimeObj && $dateTimeObj->format('Y-m-d H:i') === "{$dataInput} {$horarioInput}") {
        $descricao = htmlspecialchars($_POST['descricao'], ENT_QUOTES, 'UTF-8');
        $choqueCompromisso = false;
        $compromisso = new Compromisso($descricao, $dateTimeObj);
        foreach ($_SESSION['compromissos'] as $compromissoNaSessao) {

            if (compareCompromissosByDateTime($compromisso, $compromissoNaSessao) === 0) {
                $choqueCompromisso = true;
                break;
            }
        }
        if ($choqueCompromisso) {
            $mensagemResultado = "Erro: Choque de compromisso.";
        } else {
            $_SESSION['compromissos'][] = $compromisso;
            $mensagemResultado = "Compromisso adicionado com sucesso!";
        }
        usort($_SESSION['compromissos'], 'compareCompromissosByDateTime');

    } else {
        $mensagemResultado = "Erro: Data ou horário em formato inválido.";
    }

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
    <hr>
    <h2>Compromissos Registrados</h2>
    <?= $mensagemResultado ?>
    <hr>
    <?php if (!empty($_SESSION['compromissos'])): ?>
        <?php foreach ($_SESSION['compromissos'] as $compromisso): ?>

            <?= date_format($compromisso->getDateTime(), 'd/m/Y H:i');
            ?>
            <strong><?= $compromisso->getDescricao(); ?></strong><br>

            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum compromisso registrado no momento.</p>
    <?php endif; ?>
</body>

</html>