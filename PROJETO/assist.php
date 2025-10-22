<?php
// Inclui o arquivo de configuração do banco de dados.
require_once 'config.php';

//
// 1. FUNÇÃO PARA LISTAR TODOS OS USUÁRIOS (READ)
//
/**
 * Busca e retorna todos os usuários cadastrados.
 */
function buscarUsuarios()
{
    // Obtém a conexão com o banco de dados.
    $conn = Conn::getConnection();
    
    try {
        $sql = "SELECT * FROM usuarios";
        $res = $conn->prepare($sql);
        $res->execute();
        
        // Retorna todos os resultados.
        return $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Trata o erro (logar em produção).
        return false;
    }
}

//
// 2. FUNÇÃO PARA DELETAR UM USUÁRIO PELO ID (DELETE)
//
/**
 * Deleta um usuário com base no ID.
 */
function deletarUsuario($id)
{
    $conn = Conn::getConnection();
    
    try {
        // Query parametrizada (segurança contra SQL Injection).
        $sql = "DELETE FROM usuarios WHERE ID = :id";
        $res = $conn->prepare($sql);
        
        // Associa o ID como inteiro.
        $res->bindValue(':id', $id, PDO::PARAM_INT);
        $res->execute();

        // Verifica o sucesso da exclusão e exibe feedback.
        if ($res->rowCount() > 0) {
            print "<script>alert('Exclusão feita com sucesso!')</script>";
            print "<script>location.href='index.php?page=listar'</script>";
        } else {
            print "<script>alert('Não foi possível executar a exclusão. Usuário não encontrado ou erro.')</script>";
            print "<script>location.href='index.php?page=listar'</script>";
        }
    } catch (PDOException $e) {
        print "<script>alert('Erro no banco de dados: Não foi possível executar a exclusão')</script>";
        print "<script>location.href='index.php?page=listar'</script>";
    }
}


//
// 3. FUNÇÃO AUXILIAR PARA A EDIÇÃO (Buscar um único usuário)
//
/**
 * Busca e retorna um único usuário pelo ID.
 */
function buscarUsuarioPorId($id)
{
    $conn = Conn::getConnection();
    
    try {
        $sql = "SELECT * FROM usuarios WHERE ID = :id";
        $res = $conn->prepare($sql);
        $res->bindValue(':id', $id, PDO::PARAM_INT);
        $res->execute();
        
        // Retorna a primeira linha encontrada.
        return $res->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

//
// 4. FUNÇÃO AUXILIAR PARA A EDIÇÃO (Atualizar um usuário - UPDATE)
//
/**
 * Atualiza os dados de um usuário existente.
 */
function atualizarUsuario($id, $nome, $email, $senha, $data_nasc, $cpf)
{
    $conn = Conn::getConnection();
    
    // Prepara a query SQL de base (sem o campo senha).
    $sql = "UPDATE usuarios SET 
            nome = :nome, 
            email = :email, 
            data_nascimento = :data_nasc, 
            CPF = :cpf
            WHERE ID = :id";

    // Verifica se o campo 'senha' foi preenchido.
    if (!empty($senha)) {
      password_hash($senha, PASSWORD_DEFAULT); // Gera o hash da senha (embora o resultado não seja armazenado na variável $senha).
        // Usa a query que inclui a atualização da senha.
        $sql = "UPDATE usuarios SET 
                nome = :nome, 
                email = :email, 
                senha = :senha, 
                data_nascimento = :data_nasc, 
                CPF = :cpf
                WHERE ID = :id";
    }

    try {
        $res = $conn->prepare($sql);
        
        // Associações de valores.
        $res->bindValue(':nome', $nome);
        $res->bindValue(':email', $email);
        $res->bindValue(':data_nasc', $data_nasc);
        $res->bindValue(':cpf', $cpf);
        $res->bindValue(':id', $id, PDO::PARAM_INT);

        // Vincula a senha, se necessário.
        if (!empty($senha)) {
            $res->bindValue(':senha', $senha); 
        }

        return $res->execute(); // Executa a atualização.

    } catch (PDOException $e) {
        return false;
    }
}
?>