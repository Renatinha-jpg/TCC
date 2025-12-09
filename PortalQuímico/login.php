<?php
session_start();
include_once "conecta.php";


$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($usuario) || empty($senha)) {
        $erro = "Usuário e senha são obrigatórios.";
    } else {
        $stmt = $conn->prepare("SELECT id_usuario, usuario, senha, tipo FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($senha, $row['senha'])) {
                // Salva na sessão: ID, nome e tipo
                $_SESSION['id_usuario'] = $row['id_usuario'];
                $_SESSION['usuario'] = $row['usuario'];
                $_SESSION['tipo'] = $row['tipo'];  // 'user' ou 'admin'
                header("Location: index.php");
                exit();
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "Usuário não encontrado.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="login.css">
    <title>Portal Químico - Login</title>
    
</head>
<body>

<main class="container">
    <div class="col s12 m8 offset-m2 l6 offset-l3">

        <?php if ($erro): ?>
            <div class="card-panel red lighten-2 white-text center">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <h1>Login</h1>

            <div class="input-box">
                <input placeholder="Usuário" type="text" name="usuario" value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input placeholder="Senha" type="password" name="senha" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="login">Entrar</button>

            <div class="register">
                <p>Não tem uma conta? <a href="registrar.php">Registre-se!</a></p>
            </div>
        </form>

        <div class="voltar">
            <a href="index.php">Voltar à página inicial</a>
        </div>

    </div>
</main>

<script src="js/materialize.min.js"></script>
</body>
</html>