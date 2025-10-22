<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Usuários Cadastrados</title>
</head>

<body>
    <?php
    // Inclui o arquivo de funções de CRUD (contém buscarUsuarios e deletarUsuario).
    require_once 'assist.php';

    // --- Lógica de Exclusão (DELETE) ---
    // Verifica se o formulário de exclusão foi submetido via POST.
    if (isset($_POST["excluir"]) && $_POST["excluir"] !== "") {
        deletarUsuario($_POST["excluir"]); // Chama a função para deletar o usuário.
        // Padrão Post/Redirect/Get para evitar re-envio acidental do formulário.
        header("Location: ?page=listar");
        exit();
    }

    // --- Lógica de Leitura (READ) ---
    // Busca todos os usuários cadastrados.
    $usuarios = buscarUsuarios();
    ?>

    <div class="container mt-4">
        <h1 class="mb-4">Lista de Usuários Cadastrados</h1> 
        <?php 
        // Verifica se o array de usuários está vazio.
        if (!isset($usuarios) || empty($usuarios)) { 
        ?>
            <div class="alert alert-info" role="alert">
                Nenhum usuário cadastrado.
            </div>
        <?php 
        // Se houver usuários, exibe a tabela.
        } else { 
        ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Data de Nascimento</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Itera sobre o array de usuários para popular a tabela.
                        foreach ($usuarios as $l) { 
                        ?>
                            <tr>
                                <td> <?= ($l["nome"] ?? '') ?></td>
                                <td> <?= ($l["email"] ?? '') ?></td>
                                <td> <?= ($l["senha"] ?? '') ?></td>
                                <td> <?= ($l["data_nascimento"] ?? '') ?></td>
                                <td> <?= ($l["CPF"] ?? '') ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="?page=editar&id=<?= ($l['id'] ?? '') ?>" class="btn btn-warning btn-sm mr-2">Editar</a>
                                        
                                        <form action="?page=listar" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');" style="display:inline;">
                                            <input type="hidden" name="excluir" value="<?= ($l['id'] ?? '') ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUadn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE2T0t7E4kYkIHFek-u8W1Cyfvcw7u" crossorigin="anonymous"></script>
</body>

</html>