<?php
$msg = '';

if ($_POST) {

    // conecta ao BD
    include "conecta.php";

    // recebe os valores digitados no formulário
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // gera o hash da senha
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    // cadastra no bd
    $sql = "INSERT INTO usuarios (nome, usuario, senha, nivel) 
    VALUES ('$nome','$usuario','$senha',1)";
    
    if(mysqli_query($conexao, $sql)){
        $msg = "Usuário $nome cadastrado!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>

    <h1> Cadastro de Usuários </h1>

    <p> <?php echo $msg; ?> </p>

    <form action="" method="post">

        Nome: <br>
        <input type="text" name="nome" /> <br>

        Usuário (seu e-mail): <br>
        <input type="text" name="usuario" /> <br>

        Senha: <br>
        <input type="text" name="senha" /> <br>

        <br>

        <input type="submit" value="Cadastrar" />

    </form>

    <hr>

    <a href="index.php"> Voltar </a>

</body>

</html>