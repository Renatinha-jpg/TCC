<?php
// logout.php — VERSÃO CORRETA E SEGURA
session_start();           // inicia a sessão
session_unset();           // limpa todas as variáveis da sessão
session_destroy();         // destrói a sessão

// Redireciona direto para a home SEM passar por auth.php
header("Location: index.php");
exit();
?>