<?php
session_start();
include "conecta.php";
include "auth.php";
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    echo "Acesso negado.";
    exit;
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Pergunta inválida.";
    exit;
}

$pergunta_id = (int)$_GET['id'];
$pdo->prepare("DELETE FROM respostas WHERE pergunta_id = ?")->execute([$pergunta_id]);

$stmt = $pdo->prepare("DELETE FROM perguntas WHERE id_perguntas = ?");
$stmt->execute([$pergunta_id]);

if ($stmt->rowCount() > 0) {
    header("Location: forum.php?deletada=1");
} else {
    header("Location: forum.php?deletada=0");
}
exit;
?>