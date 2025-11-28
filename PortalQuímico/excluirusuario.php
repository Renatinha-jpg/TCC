<?php
include "conecta.php";
$id = $_POST['id'];
$sql = "DELETE FROM usuario WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    header('Location: usuariosadm.php');
}
?>