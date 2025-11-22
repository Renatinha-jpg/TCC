<?php

if ($_POST) {

    // conecta ao BD
    include "conecta.php";

    // inicia a sessão
    session_start();

    // recebe os valores digitados no formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // consulta a base de dados
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);

    // verifica se os dados estão corretos
    if (!empty($dados) and password_verify($senha, $dados['senha'])) {
        
        // cria as variáveis de sessão
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['nivel'] = $dados['nivel'];

        switch($_SESSION['nivel']){
            case 1:
                header('Location: principal.php');
                break;
            case 2:
                header('Location: admin.php');
                break;
        }
                
    } else {
        // retorna para a página de login
        header('Location: index.php');
    }
} else {
    // retorna para a página de login
    header('Location: index.php');
}
