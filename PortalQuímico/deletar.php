<?php
session_start();
include_once "conecta.php";
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    die("Acesso negado.");
}

if (!isset($_POST['id'])) {
    header("Location: materiaisadm.php");
    exit();
}

$id = (int)$_POST['id'];

$stmt = $conn->prepare("SELECT material FROM materiais WHERE id_material = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $arquivo = $row['material'];
    $caminho = __DIR__ . "/materiais/" . $arquivo;

    $delete = $conn->prepare("DELETE FROM materiais WHERE id_material = ?");
    $delete->bind_param("i", $id);

    if ($delete->execute()) {
        if (file_exists($caminho)) {
            unlink($caminho);
        }
        header("Location: materiaisadm.php?excluido=1");
    } else {
        header("Location: materiaisadm.php?erro=1");
    }
} else {
    header("Location: materiaisadm.php?erro=1");
}
exit();
?>