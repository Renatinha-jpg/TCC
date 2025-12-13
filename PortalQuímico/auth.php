<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$paginas_publicas = [
    'login.php',
    'registrar.php',
    'logout.php',
    'index.php',
    'materiais.php',
    'destaque1.php',
    'destaque2.php',
    'destaque3.php'
];

$pagina_atual = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['id_usuario']) && !in_array($pagina_atual, $paginas_publicas)) {
    $_SESSION['ultima_pagina'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

function eh_admin()
{
    return isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
}
