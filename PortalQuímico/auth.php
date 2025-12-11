<?php
// includes/iniciar_sessao.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Lista de páginas que podem ser acessadas sem login
$paginas_publicas = [
    'login.php',
    'registrar.php',
    'logout.php',
    'index.php',        // opcional: permite ver a home sem login
    'materiais.php'
];

$pagina_atual = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['id_usuario']) && !in_array($pagina_atual, $paginas_publicas)) {
    // Salva a página que o usuário queria acessar
    $_SESSION['ultima_pagina'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Função auxiliar (opcional)
function eh_admin() {
    return isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
}
?>