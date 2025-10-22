<?php
// Certifique-se de que o arquivo de configuração do banco de dados está incluído
require_once 'config.php';

//
// 1. FUNÇÃO PARA LISTAR TODOS OS USUÁRIOS
//
/**
 * Busca e retorna todos os usuários cadastrados no banco de dados.
 * @return array|bool Um array de usuários ou false se a busca falhar.
 */
function buscarUsuarios()
{
    // Obtém a conexão com o banco de dados
    $conn = Conn::getConnection();
    
    try {
        $sql = "SELECT * FROM usuarios";
        $res = $conn->prepare($sql);
        $res->execute();
        
        // Retorna todos os resultados como um array associativo
        return $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Em um ambiente de produção, você deve logar o erro, não exibi-lo.
        // echo "Erro ao buscar usuários: " . $e->getMessage();
        return false;
    }
}

//
// 2. FUNÇÃO PARA DELETAR UM USUÁRIO PELO ID
//
/**
 * Deleta um usuário do banco de dados com base no ID fornecido.
 * @param int $id O ID do usuário a ser deletado.
 */
function deletarUsuario($id)
{
    $conn = Conn::getConnection();
    
    // Usando try-catch para lidar com erros de banco de dados
    try {
        // QUERY PARAMETRIZADA: Proteção contra SQL Injection
        $sql = "DELETE FROM usuarios WHERE ID = :id";
        $res = $conn->prepare($sql);
        
        // Associa o valor com o tipo de dado correto (inteiro)
        $res->bindValue(':id', $id, PDO::PARAM_INT);
        $res->execute();

        // Verifica se alguma linha foi afetada
        if ($res->rowCount() > 0) {
            // Sucesso na exclusão
            print "<script>alert('Exclusão feita com sucesso!')</script>";
            // Redirecionamento de volta para a página de listagem
            print "<script>location.href='index.php?page=listar'</script>";
        } else {
            // ID não encontrado ou erro
            print "<script>alert('Não foi possível executar a exclusão. Usuário não encontrado ou erro.')</script>";
            print "<script>location.href='index.php?page=listar'</script>";
        }
    } catch (PDOException $e) {
        // Em caso de erro de conexão ou SQL
        print "<script>alert('Erro no banco de dados: Não foi possível executar a exclusão')</script>";
        // print "Erro: " . $e->getMessage(); // Descomente para debug
        print "<script>location.href='index.php?page=listar'</script>";
    }
}


//
// 3. FUNÇÃO AUXILIAR PARA A EDIÇÃO (Buscar um único usuário)
//
/**
 * Busca e retorna um único usuário pelo seu ID.
 * @param int $id O ID do usuário a ser buscado.
 * @return array|bool Um array associativo com os dados do usuário ou false se não encontrado.
 */
function buscarUsuarioPorId($id)
{
    $conn = Conn::getConnection();
    
    try {
        $sql = "SELECT * FROM usuarios WHERE ID = :id";
        $res = $conn->prepare($sql);
        $res->bindValue(':id', $id, PDO::PARAM_INT);
        $res->execute();
        
        // Retorna a primeira linha encontrada
        return $res->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // echo "Erro ao buscar usuário: " . $e->getMessage();
        return false;
    }
}

//
// 4. FUNÇÃO AUXILIAR PARA A EDIÇÃO (Atualizar um usuário)
//
/**
 * Atualiza os dados de um usuário existente.
 * @param int $id O ID do usuário a ser atualizado.
 * @param string $nome O novo nome.
 * @param string $email O novo email.
 * @param string $senha A nova senha (pode ser vazia).
 * @param string $data_nasc A nova data de nascimento.
 * @param string $cpf O novo CPF.
 * @return bool True em caso de sucesso, false em caso de falha.
 */
function atualizarUsuario($id, $nome, $email, $senha, $data_nasc, $cpf)
{
    $conn = Conn::getConnection();
    
    // Prepara a query SQL de base
    $sql = "UPDATE usuarios SET 
            nome = :nome, 
            email = :email, 
            data_nascimento = :data_nasc, 
            CPF = :cpf
            WHERE ID = :id";

    // Adiciona o campo 'senha' à query APENAS se uma nova senha for fornecida
    if (!empty($senha)) {
      password_hash($senha, PASSWORD_DEFAULT);
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
        
        // Associa os valores comuns
        $res->bindValue(':nome', $nome);
        $res->bindValue(':email', $email);
        $res->bindValue(':data_nasc', $data_nasc);
        $res->bindValue(':cpf', $cpf);
        $res->bindValue(':id', $id, PDO::PARAM_INT);

        // Associa a senha, se houver
        if (!empty($senha)) {
            $res->bindValue(':senha', $senha); 
        }

        return $res->execute();

    } catch (PDOException $e) {
        // echo "Erro ao atualizar usuário: " . $e->getMessage();
        return false;
    }
}
?>