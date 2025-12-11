<?php
include "auth.php";
include "conecta.php";
$id = $_POST['id'];
$sql = "DELETE FROM usuarios WHERE id_usuario = $id";
$resultado = mysqli_query($conn, $sql);

if ($resultado) {
    header('Location: usuariosadm.php');
}
?>