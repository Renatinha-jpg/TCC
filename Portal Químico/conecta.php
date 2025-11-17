<?php
function conectar()
{
    $conexao = mysqli_connect("localhost", "root", "", "quimica");
    if (mysqli_connect_errno()) {
        die("Erro ao conectar ao banco de dados!");
    }
    return $conexao;
}
?>