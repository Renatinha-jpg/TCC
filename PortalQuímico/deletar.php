<?php
session_start();

// Só admin pode deletar
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    die("Acesso negado. Você não é administrador.");
}

if (!isset($_GET['arquivo']) || empty($_GET['arquivo'])) {
    die("Nenhum arquivo informado.");
}

// Segurança: remove qualquer tentativa de path traversal
$nome_arquivo = basename($_GET['arquivo']);
$caminho_arquivo = __DIR__ . "/materiais/" . $nome_arquivo;

// Verifica se o arquivo realmente existe
if (!file_exists($caminho_arquivo)) {
    die("Erro: Arquivo não encontrado no servidor.<br>
         Nome esperado: <code>$nome_arquivo</code><br>
         Caminho verificado: <code>$caminho_arquivo</code>");
}

include_once "conecta.php";

// Primeiro apaga do banco
$sql = "DELETE FROM materiais WHERE material = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome_arquivo);

if ($stmt->execute()) {
    // Depois apaga o arquivo físico
    if (unlink($caminho_arquivo)) {
        header("Location: materiaisadm.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao deletar o arquivo do servidor (permissão?).";
    }
} else {
    echo "Erro ao deletar do banco de dados: " . $conn->error;
}

$stmt->close();
$conn->close();
?>