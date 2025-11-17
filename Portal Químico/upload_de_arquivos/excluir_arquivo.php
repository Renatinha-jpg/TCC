<?php
require_once "conexao.php";
$id_arquivo = $_GET['id'];
$conexao = conectar();
$sql = "SELECT * FROM arquivo WHERE id_arquivo=$id_arquivo";
$result = executarSQL($conexao, $sql);
$arquivo = mysqli_fetch_assoc($result);

$deletou = unlink('./uploads/' . $arquivo['caminho']);
if($deletou == false){
    die("erro ao apagar arquivo do disco.");
}
$sql = "DELETE FROM arquivo WHERE id_arquivo=$id_arquivo";
executarSQL($conexao, $sql);
header("Location: listar_arquivos.php");
?>