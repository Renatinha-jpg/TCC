<?php

// inicia a sessão
session_start();

/* verifica se existe uma sessão válida e se tem permissão, 
   senão redireciona para a página de login */
if(!isset($_SESSION['id']) or $_SESSION['nivel'] != 2){
    header('Location: index.php');
}

include "conecta.php";

// Seleciona todos os dados da tabela usuarios
$sql = "SELECT * FROM usuarios"; 

// Executa o Select 
$resultado = mysqli_query($conexao,$sql); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    
<h1> Administração </h1>

<h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>
<hr>

<h1> Usuários </h1>

<p> <a href="cadastrar.php"> Cadastrar novo usuário </a> </p>

<?php
if(!empty($resultado)){

    //Lista os usuários
    echo "<table border=1>";
    echo "<tr> 
          <th> NOME </th> 
          <th> USUARIO </th> 
          <th> NIVEL </th> 
          <th> OPÇÕES </th> 
          </tr>";
    while ($dados = mysqli_fetch_assoc($resultado)) { 
        echo "<tr>";
        echo "<td> {$dados['nome']} </td>"; 
        echo "<td> {$dados['usuario']} </td>";
        echo "<td> {$dados['nivel']} </td>";
        echo "<td align='center'> 
            <a href='editar.php?id={$dados['id']}'><img src='imagens/editar.png' height='15' weight='15'></a> 
            | 
            <a href='deletar.php?id={$dados['id']}'><img src='imagens/deletar.png' height='15' weight='15'></a> 
            </td>"; 
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "Ainda não há usuários cadastrados.";
}
?>

<hr>

<a href="index.php"> Voltar </a> | <a href="logout.php"> Sair </a>

</body>
</html>