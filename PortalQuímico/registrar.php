<?php
include_once "conecta.php";

$mensagem = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $senha   = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if (empty($usuario) || empty($email) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido.";
    } elseif ($senha !== $confirmar) {
        $erro = "As senhas não coincidem.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } elseif (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿÇç ]+$/", $usuario)) {
        $erro = "Nome de usuário inválido (apenas letras e espaços).";
    } else {
        $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE usuario = ? OR email = ?");
        $stmt->bind_param("ss", $usuario, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $erro = "Usuário ou e-mail já cadastrado.";
        } else {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario, email, senha, tipo) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $usuario, $email, $hash);

            if ($stmt->execute()) {
                $mensagem = "Cadastro realizado com sucesso! Faça login para continuar.";
                $_POST = [];
            } else {
                $erro = "Erro ao cadastrar. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Químico - Cadastro</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registro.css">
</head>

<body>

    <div class="container">
        <h1>Cadastrar-se</h1>
        <?php if ($mensagem): ?>
            <div class="toast" id="toast">
                <i class='bx bx-check-circle' style="font-size:1.8rem;"></i>
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <?php if ($erro): ?>
            <div style="background:rgba(244,67,54,0.2); padding:15px; border-radius:10px; margin:0px 20px; text-align:center;">
                <strong style="color:#f44336;"><?php echo $erro; ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-box">
                <input type="text" id="usuario" name="usuario" required
                    value="<?php echo htmlspecialchars($_POST['usuario'] ?? ''); ?>"
                    pattern="^[A-Za-zÀ-ÖØ-öø-ÿÇç ]+$" maxlength="40">
                <label for="usuario">Usuário</label>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input id="email" type="email" name="email" required
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <label for="email">E-mail</label>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" id="senha" name="senha" required minlength="6">
                <label for="senha">Senha</label>
                <i class='bx bxs-lock'></i>
            </div>

            <div class="input-box">
                <input type="password" id="confirmar" name="confirmar" required>
                <label for="confirmar">Confirmar Senha</label>
                <i class='bx bxs-lock'></i>
            </div>

            <div id="mensagem-senha" style="text-align:center; margin:10px 0; min-height:24px;"></div>

            <button type="submit" class="register" id="register" disabled>Registrar</button>

            <p>Já tem uma conta? <a href="login.php">Faça login</a><br>
                <a href="index.php">Voltar à página inicial</a>
            </p>
        </form>
    </div>

    <script src="js/materialize.min.js"></script>
    <script>
        const senha = document.getElementById("senha");
        const confirmar = document.getElementById("confirmar");
        const botao = document.getElementById("register");
        const msg = document.getElementById("mensagem-senha");

        function verificarSenhas() {
            if (senha.value === "" || confirmar.value === "") {
                botao.disabled = true;
                msg.textContent = "";
                return;
            }
            if (senha.value !== confirmar.value) {
                botao.disabled = true;
                msg.textContent = "Senhas diferentes";
                msg.style.color = "red";
            } else {
                botao.disabled = false;
                msg.textContent = "Senhas iguais!";
                msg.style.color = "green";
            }
        }

        senha.addEventListener("input", verificarSenhas);
        confirmar.addEventListener("input", verificarSenhas);

        // Toast flutuante
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 600);
            }, 5000);
        }
    </script>
</body>

</html>