<?php

require_once 'ContaBancaria.php';
use Exercicio_11\ContaBancaria;

session_start();
if (!isset($_SESSION['conta'])) {
    $_SESSION['conta'] = new ContaBancaria();
    $saldoAtual = 0;
} else {
    $saldoAtual = $_SESSION['conta']->getSaldo();
}

$resposta = null;
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty($_POST['operacao']) && !empty($_POST['valor'])
) {
    $operacao = htmlspecialchars($_POST['operacao'], ENT_QUOTES, 'UTF-8');
    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if ($operacao === 'deposito') {
        $_SESSION['conta']->depositar($valor);
        $resposta = 'Depositado com sucesso!';
    }
    if ($operacao === 'saque') {
        if ($_SESSION['conta']->sacar($valor))
            $resposta = 'Sacado com sucesso!';
        else
            $resposta = 'Erro ao sacar, saldo insuficiente.';
    }
    $saldoAtual = $_SESSION['conta']->getSaldo();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Conta Bancária (em Sessão)</title>
</head>

<body>
    <h1>Simulador de Conta Bancária (em Sessão)</h1>
    <form action="index.php" method="post">
        <label for="operacao">Selecione a operação:</label>
        <select name="operacao" id="operacao" required>
            <option value="" selected disabled>--- Operação Bancária ---</option>
            <option value="deposito">Depósito</option>
            <option value="saque">Saque</option>
        </select>
        <label for="valor">Valor: R$</label>
        <input type="number" name="valor" id="valor" placeholder="11,99" required>
        <button type="submit" id="botaoOperacao">Operação</button>
    </form>

    <hr>
    <?php if (isset($resposta)): ?>
        <p><?= $resposta ?></p>
    <?php endif; ?>
    <?php
    $saldoAtual = number_format($saldoAtual, 2, ',', '.');

    ?>
    <p>Saldo atual: <strong>R$ <?= $saldoAtual ?></strong></p>

    <script>
        const operacao = document.getElementById('operacao');
        const botaoOperacao = document.getElementById('botaoOperacao');
        operacao.addEventListener('change', function () {
            const operacaoSelecionada = this.value;
            botaoOperacao.textContent = operacaoSelecionada === 'deposito' ? 'Depositar' : 'Sacar';
        });
    </script>

</body>

</html>