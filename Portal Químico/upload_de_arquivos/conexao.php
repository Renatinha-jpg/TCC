<?php

function conectar()
{
    $conexao = mysqli_connect("localhost", "root", "", "upload_arquivos");
    if (mysqli_connect_errno()) {
        die("Erro ao conectar ao banco de dados!");
    }
    return $conexao;
}

function executarSQL($conexao, $sql){
    $result = mysqli_query($conexao, $sql);
    if ($result == false){
        die("erro ao executar o sql". mysqli_error($conexao));
    }
    return $result;
}