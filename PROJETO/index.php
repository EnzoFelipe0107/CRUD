<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CRUD</title>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Cadastro de Usuários</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=novo">Novo usuário</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=listar">Listar usuários</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col mt- 5">
                <?php
                // Inclui o arquivo de configuração (conexão).
                include("config.php");

                // --- Lógica de Roteamento (Switch/Case) ---
                // Verifica o parâmetro 'page' na URL (GET) para incluir o arquivo correto.
                switch (@$_REQUEST["page"]) {

                    case "novo":
                        // Rota: Formulário de criação.
                        include("novo-usuario.php");
                        break;
                    case "listar":
                        // Rota: Tabela de listagem (READ).
                        include("listar-usuario.php");
                        break;
                    case "salvar";
                        // Rota: Processamento de INSERT/DELETE/etc.
                        include("salvar-usuario.php");
                        break;
                    case "editar":
                        // Rota: Formulário de edição/update.
                        include("editar-usuario.php");
                        break;
                    default:
                        // Rota Padrão (Home).
                        print "<h1>Bem vindo!</h1>";
                        print "<h2> Acesse a Navbar acima para interagir com nosso banco de dados! </h2>";
                }
                ?>
            </div>
        </div>
    </div>
                
</body>

</html>