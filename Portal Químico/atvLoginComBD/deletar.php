<?php

$id = $_GET['id'];
include "conecta.php";

$sql = "DELETE FROM usuarios WHERE id = $id";
mysqli_query($conexao,$sql);

header('Location: admin.php');