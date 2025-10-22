<?php
// Inclui o arquivo com as funções de CRUD (buscarUsuarioPorId, atualizarUsuario).
require_once 'assist.php';

// 1. Verificar e validar o ID do usuário na URL (GET)
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona se o ID for inválido ou ausente.
   header("Location: index.php?page=listar");;
    exit();
}

$id_usuario = $_GET['id'];

// 2. Busca inicial do usuário no banco de dados.
$usuario = buscarUsuarioPorId($id_usuario);

// 3. Se a busca falhar, redireciona.
if (!$usuario) {
    header("Location: index.php?page=listar");;
    exit();
}

// 4. Processamento da Submissão do Formulário (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['acao'] === 'editar') {
    // Coleta e sanitiza os dados do formulário.
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $data_nasc = $_POST['data_nasc'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    // Chama a função para executar o UPDATE no banco.
    if (atualizarUsuario($id_usuario, $nome, $email, $senha, $data_nasc, $cpf)) {
        // Sucesso: Redireciona com status de sucesso.
        header("Location: ?page=listar&status=success_edit");
        exit();
    } else {
        // Falha: Redireciona com status de erro.
        header("Location: ?page=listar&status=error_edit");
        exit();
    }
}
// O código HTML/Bootstrap abaixo é exibido para o usuário (formulário).
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Editar Usuário</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Usuário: <?= ($usuario['nome'] ?? 'Usuário') ?></h1>
        
        <form action="editar-usuario.php?id=<?= $id_usuario ?>" method="POST">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="id" value="<?=($id_usuario) ?>">

            <div class="form-group mb-3">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?=($usuario['nome'] ?? '') ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?=($usuario['email'] ?? '') ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="senha">Nova Senha (Preencha somente se quiser alterar)</label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Deixe em branco para manter a senha atual">
            </div>

            <div class="form-group mb-3">
                <label for="data_nasc">Data de Nascimento</label>
                <input type="date" id="data_nasc" name="data_nasc" class="form-control" value="<?=($usuario['data_nascimento'] ?? '') ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" class="form-control" maxlength="14" value="<?=($usuario['CPF'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="?page=listar" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUadn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE2T0t7E4kYkIHFek-u8W1Cyfvcw7u" crossorigin="anonymous"></script>
</body>
</html>