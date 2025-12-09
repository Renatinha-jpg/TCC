<?php include "conecta.php"; 
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $email, $senha);
    if ($stmt->execute()) {
        echo "<p class='green-text'>Cadastro realizado! <a href='login.php'>Login</a></p>";
    } else {
        echo "<p class='red-text'>Erro ao cadastrar.</p>";
    }
}
?>
