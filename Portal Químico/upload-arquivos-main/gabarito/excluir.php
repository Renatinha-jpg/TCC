<?php
session_start();
$id = $_GET['id'];
$conexao = mysqli_connect("localhost", "root", "", "upload");
$sql = "SELECT * FROM arquivo WHERE id_arquivo = $id";
$resultSet = mysqli_query($conexao, $sql);
$arquivo = mysqli_fetch_assoc($resultSet);

$sql2 = "DELETE FROM arquivo WHERE id_arquivo = $id";
$resultSet2 = mysqli_query($conexao, $sql2);
if ($resultSet2) {
    $excluiu = unlink("uploads/" . $arquivo['nome']);
    if ($excluiu) {
        $_SESSION['mensagem'] = "Arquivo excluído com sucesso!";
        header("Location: index.php");
        die();
    }
}
$_SESSION['mensagem'] = "Problemas ao excluir o arquivo!";
header("Location: index.php");