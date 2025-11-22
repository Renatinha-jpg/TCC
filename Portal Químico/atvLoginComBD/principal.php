<?php

// inicia a sessão
session_start();

/* verifica se existe uma sessão válida e se tem permissão, 
   senão redireciona para a página de login */
if(!isset($_SESSION['id']) or $_SESSION['nivel'] != 1){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>

<h1> Página Principal! </h1>

<h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>
<hr>
<p> <a href="logout.php">Sair</a> </p>
    
</body>
</html>