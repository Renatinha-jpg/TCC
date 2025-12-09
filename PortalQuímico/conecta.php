<?php
// conecta.php — versão correta e segura (MySQLi)

$servidor = "localhost";
$usuario  = "root";          // padrão do XAMPP
$senha    = "";              // padrão do XAMPP (vazio)
$banco    = "quimica"; // ← MUDE AQUI PARA O NOME DO SEU BANCO

// Cria a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se conectou
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Define charset para aceitar acentos
$conn->set_charset("utf8mb4");
?>
