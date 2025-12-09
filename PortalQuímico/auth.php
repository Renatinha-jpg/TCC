<?php
session_start(); 

// logado
function is_logged_in() {
    return isset($_SESSION['id_usuario']);
}

// é admin
function is_admin() {
    return isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
}

// redireciona se não logado
if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}
?>