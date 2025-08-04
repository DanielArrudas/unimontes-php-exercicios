<?php
require_once 'Produto.php';
use Exercicio_09\Produto;

session_start();
if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

$mensagemResultado = null;

if (isset($_POST['adicionar'])) {
    if (!empty($_POST['nome']) && !empty($_POST['qtd']) && isset($_POST['preco'])) {
        $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
        $qtd = (int) filter_input(INPUT_POST, 'qtd', FILTER_SANITIZE_NUMBER_INT);
        $preco = (float) filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $produtoExiste = false;
        foreach ($_SESSION['produtos'] as $produtoNaSessao) {
            if ($produtoNaSessao->getNome() === $nome) {
                $produtoExiste = true;
                break;
            }
        }

        if ($produtoExiste) {
            $mensagemResultado = "Erro: Produto já cadastrado.";
        } else {
            $produto = new Produto($nome, $qtd, $preco);
            $_SESSION['produtos'][] = $produto;
            $mensagemResultado = "Produto adicionado com sucesso!";
        }
    }
}

if (isset($_POST['atualizar']) && isset($_POST['produto_key'])) {
    $key = $_POST['produto_key'];
    if (isset($_SESSION['produtos'][$key])) {
        $novaQtd = (int) filter_input(INPUT_POST, 'novaQtd', FILTER_SANITIZE_NUMBER_INT);
        $novoPreco = (float) filter_input(INPUT_POST, 'novoPreco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        $_SESSION['produtos'][$key]->setQtd($novaQtd);
        $_SESSION['produtos'][$key]->setPreco($novoPreco);

        $mensagemResultado = "Produto atualizado com sucesso!";
    }
}

if (isset($_POST['remover']) && isset($_POST['produto_key'])) {
    $key = $_POST['produto_key'];
    if (isset($_SESSION['produtos'][$key])) {
        unset($_SESSION['produtos'][$key]);
        $_SESSION['produtos'] = array_values($_SESSION['produtos']);
        $mensagemResultado = "Produto removido com sucesso!";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque com Sessão</title>
</head>

<body>
    <h1>Controle de Estoque com Sessão</h1>

    <h2>Adicionar Produto</h2>
    <form action="index.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome do Produto" required>
        <label for="qtd">Quantidade:</label>
        <input type="number" id="qtd" name="qtd" placeholder="10" min="0" required>
        <label for="preco">Preço: R$</label>
        <input type="number" id="preco" name="preco" placeholder="10.50" min="0.01" step="0.01" required>
        <button type="submit" name="adicionar">Adicionar</button>
    </form>
    <hr>

    <?php if ($mensagemResultado): ?>
        <p><strong><?= $mensagemResultado ?></strong></p>
    <?php endif; ?>

    <h2>Estoque de Produtos</h2>
    <?php if (!empty($_SESSION['produtos'])): ?>
        <?php foreach ($_SESSION['produtos'] as $key => $produto): ?>
            <form action="index.php" method="post" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <strong><?= $produto->getNome(); ?></strong><br>

                <input type="hidden" name="produto_key" value="<?= $key ?>">

                <label for="novaQtd-<?= $key ?>">Quantidade:</label>
                <input type="number" id="novaQtd-<?= $key ?>" name="novaQtd" value="<?= $produto->getQtd(); ?>" min="0"
                    required>

                <label for="novoPreco-<?= $key ?>">Preço: R$</label>
                <input type="number" id="novoPreco-<?= $key ?>" name="novoPreco" value="<?= $produto->getPreco(); ?>" min="0.01"
                    step="0.01" required>

                <button type="submit" name="atualizar">Atualizar</button>
                <button type="submit" name="remover"
                    onclick="return confirm('Tem certeza que deseja remover este produto?');">Remover</button>
            </form>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum produto cadastrado no momento.</p>
    <?php endif; ?>
</body>

</html>