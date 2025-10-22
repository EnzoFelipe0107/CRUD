<?php
require_once 'config.php';

$conn = Conn::getConnection();

switch ($_POST["acao"]) {
    case 'cadastrar':
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $data_nasc = $_POST["data_nasc"];
        $CPF = $_POST["cpf"];

        $sql = "INSERT INTO  usuarios (nome, email, senha, data_nascimento, cpf)
          VALUES (:nome,:email,:senha,:data_nasc,:cpf)";
        $res = $conn->prepare($sql);

        $res->bindValue(':nome', $nome, PDO::PARAM_STR);
        $res->bindValue(':email', $email, PDO::PARAM_STR);
        $res->bindValue(':senha', $senha, PDO::PARAM_STR);
        $res->bindValue(':data_nasc', $data_nasc, PDO::PARAM_STR);
        $res->bindValue(':cpf', $CPF, PDO::PARAM_STR);
        $res->execute();
        






 if ($res== true)
    {
   print "<script>alert ('Cadastro feito com sucesso!')</script>";
    print "<script>location.href='index.php?page=listar'</script>";

    }else{
    print "<script>alert ('Não foi possivel executar seu cadastro')</script>";
    print "<script>location.href='index.php?page=listar'</script>";
   }
 
        break;
    case 'editar':

        break;
    case 'excluir':

        break;
    default:

        break;
}
