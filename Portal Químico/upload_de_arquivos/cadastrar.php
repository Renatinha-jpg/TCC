<?php

$nome = $_POST['nome'];
//var_dump($_FILES);

$pasta = './uploads/';
$nomesArquivo = md5(time());
$nomeCompleto = $_FILES['arquivo']['name'];
$nomeSeparado = explode( '.', $nomeCompleto);
$ultimaPosição = count($nomeSeparado);
$extensao = $nomeSeparado[$ultimaPosição - 1];
$nomesArquivoExtensao = $nomesArquivo . '.' . $extensao;

//var_dump($nomesArquivoExtensao);

$check = getimagesize($_FILES["arquivo"]["tmp_name"]);
if($check == false) {
    echo "este arquivo não é uma imagem!";
}

if($_FILES['arquivo']['size'] > 1048576){
    echo "o arquivo é muito grande!";
}

if(
    $extensao != "jpg" &&
    $extensao != "png" &&
    $extensao != "jpeg" &&
    $extensao != "gif" &&
    $extensao != "pdf" &&
    $extensao != "mp4"
) {
    echo "o formato do arquivo é invalido!";
}

$feitoUpload = move_uploaded_file($_FILES['arquivo']["tmp_name"], $pasta . $nomesArquivoExtensao);

if($feitoUpload == true){
    require_once "conexao.php";
    $conexao = conectar();
        $sql = "INSERT INTO arquivo (nome, caminho) VALUES
        ('$nome', '$nomesArquivoExtensao')";
        executarSQL($conexao, $sql);
        header("Location: listar_arquivos.php");
}