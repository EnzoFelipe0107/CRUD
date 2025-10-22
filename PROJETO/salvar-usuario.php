<?php
// Inclui o arquivo de configuração da conexão com o banco.
require_once 'config.php';

// Obtém a conexão PDO (Singleton).
$conn = Conn::getConnection();

// Inicia o roteamento com base na ação enviada pelo formulário.
switch ($_POST["acao"]) {
    case 'cadastrar':
        // 1. Coleta os dados do formulário (POST).
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        // NOTA: md5() é inseguro; recomendado usar password_hash() para senhas.
        $senha = md5($_POST["senha"]); 
        $data_nasc = $_POST["data_nasc"];
        $CPF = $_POST["cpf"];

        // 2. Query parametrizada para INSERT (proteção contra SQL Injection).
        $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento, cpf)
             VALUES (:nome,:email,:senha,:data_nasc,:cpf)";
        $res = $conn->prepare($sql);

        // 3. Associa os valores às variáveis da query (bindValue).
        $res->bindValue(':nome', $nome, PDO::PARAM_STR);
        $res->bindValue(':email', $email, PDO::PARAM_STR);
        $res->bindValue(':senha', $senha, PDO::PARAM_STR);
        $res->bindValue(':data_nasc', $data_nasc, PDO::PARAM_STR);
        $res->bindValue(':cpf', $CPF, PDO::PARAM_STR);
        $res->execute(); // Executa a inserção no banco.
        
        // 4. Verifica o resultado da execução e fornece feedback.
        // NOTA: A variável $res é um objeto PDOStatement e é 'true' se a preparação for OK.
        // A checagem de sucesso real pode ser feita com try/catch ou rowCount.
        
        if ($res == true) // Condição que verifica se a execução foi iniciada.
        {
            print "<script>alert ('Cadastro feito com sucesso!')</script>";
            print "<script>location.href='index.php?page=listar'</script>";

        } else {
            print "<script>alert ('Não foi possivel executar seu cadastro')</script>";
            print "<script>location.href='index.php?page=listar'</script>";
        }
        
        break;
        
    case 'editar':
        // Ação de edição (implementada em outro arquivo/função).
        break;
        
    case 'excluir':
        // Ação de exclusão (implementada em outro arquivo/função).
        break;
        
    default:
        // Caso a ação não seja reconhecida.
        break;
}