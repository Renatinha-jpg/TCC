<?php
session_start();
$id = $_GET['id_material'];
$conexao = mysqli_connect("localhost", "root", "", "upload");
$sql = "SELECT * FROM materiais WHERE id_material = $id";
$resultSet = mysqli_query($conexao, $sql);
$arquivo = mysqli_fetch_assoc($resultSet);

$sql2 = "DELETE FROM materiais WHERE id_material = $id";
$resultSet2 = mysqli_query($conexao, $sql2);
if ($resultSet2) {
    $excluiu = unlink("materiais/" . $arquivo['nome']);
    if ($excluiu) {
        $_SESSION['mensagem'] = "Arquivo excluído com sucesso!";
        header("Location: index.php");
        die();
    }
}
$_SESSION['mensagem'] = "Problemas ao excluir o arquivo!";
header("Location: index.php");