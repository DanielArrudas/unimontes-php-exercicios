<?php
require_once 'Aluno.php';
use Exercicio_07\Aluno;

session_start();

if (!isset($_SESSION['alunos'])) {
    $_SESSION['alunos'] = [];
}

if (isset($_POST['limpar'])) {
    $_SESSION['alunos'] = [];
    header("Location: index.php");
    exit();
}

$mensagemResultado = null;
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && !empty($_POST['nome'])
    && !empty($_POST['matricula'])
    && !empty($_POST['curso'])
) {
    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
    $matricula = htmlspecialchars($_POST['matricula'], ENT_QUOTES, 'UTF-8');
    $curso = htmlspecialchars($_POST['curso'], ENT_QUOTES, 'UTF-8');

    $matriculaExiste = false;
    foreach ($_SESSION['alunos'] as $alunoNaSessao) {
        if ($alunoNaSessao->getMatricula() === $matricula) {
            $matriculaExiste = true;
            break;
        }
    }

    if ($matriculaExiste) {
        $mensagemResultado = "Erro: Matrícula já cadastrada.";
    } else {
        $aluno = new Aluno($nome, $matricula, $curso);
        $_SESSION['alunos'][] = $aluno;
        $mensagemResultado = "Aluno cadastrado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro de Alunos (em Sessão)</title>
</head>

<body>
    <h1>Sistema de Cadastro de Alunos (em Sessão)</h1>

    <h2>Novo aluno:</h2>
    <form action="index.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="João da Silva" required>

        <label for="matricula">Matrícula:</label>
        <input type="number" id="matricula" name="matricula" placeholder="100098765" min="1" required>

        <label for="curso">Curso:</label>
        <input type="text" id="curso" name="curso" placeholder="Sistemas de Informação" required>

        <button type="submit">Cadastrar</button>
    </form>

    <hr>

    <?php if ($mensagemResultado): ?>
        <p><strong><?= $mensagemResultado ?></strong></p>
    <?php endif; ?>

    <h2>Alunos Cadastrados</h2>

    <?php
    if (!empty($_SESSION['alunos'])):
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['alunos'] as $aluno): ?>
                    <tr>
                        <td><?= $aluno->getNome(); ?></td>
                        <td><?= $aluno->getMatricula(); ?></td>
                        <td><?= $aluno->getCurso(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="index.php" method="post" style="margin-top: 20px;">
            <button type="submit" name="limpar">Limpar Todos os Alunos</button>
        </form>

    <?php else: ?>
        <p>Nenhum aluno cadastrado no momento.</p>
    <?php endif; ?>
</body>

</html>