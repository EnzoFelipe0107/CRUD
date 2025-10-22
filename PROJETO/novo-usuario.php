<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastro de Usuário</title>
</head>
<body>
    <div class="container mt-5"> <h1 class="mb-4">Criar Novo Usuário</h1> <form action="salvar-usuario.php" method="POST">
            <input type="hidden" name="acao" value="cadastrar">

            <div class="form-group mb-3"> <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-control" minlength="6" required>
            </div>

            <div class="form-group mb-3">
                <label for="data_nasc">Data de Nascimento</label>
                <input type="date" id="data_nasc" name="data_nasc" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" class="form-control" maxlength="14">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE2T0t7E4kYkIHFek-u8W1Cyfvcw7u" crossorigin="anonymous"></script>
</body>
</html>