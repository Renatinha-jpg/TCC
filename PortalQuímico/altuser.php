<?php
session_start();
include_once "conecta.php";
include "auth.php";

$mensagem = $erro = "";
$id_usuario = $_GET['id'] ?? 0;
$id_usuario = (int)$id_usuario;

if ($id_usuario <= 0) {
    header("Location: gerenciar_usuarios.php");
    exit();
}

$sql = "SELECT id_usuario, usuario, email, tipo FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($usuario = $resultado->fetch_assoc()) {
} else {
    $erro = "Usuário não encontrado.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_usuario = trim($_POST['usuario']);
    $novo_email   = trim($_POST['email']);
    $novo_tipo    = $_POST['tipo'];

    if (empty($novo_usuario) || empty($novo_email)) {
        $erro = "Nome de usuário e e-mail são obrigatórios.";
    } elseif (!in_array($novo_tipo, ['user', 'admin'])) {
        $erro = "Tipo de usuário inválido.";
    } else {
        $sql = "UPDATE usuarios SET usuario = ?, email = ?, tipo = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $novo_usuario, $novo_email, $novo_tipo, $id_usuario);

        if ($stmt->execute()) {
            $mensagem = "Usuário atualizado com sucesso!";
            $usuario['usuario'] = $novo_usuario;
            $usuario['email']   = $novo_email;
            $usuario['tipo']    = $novo_tipo;
        } else {
            $erro = "Erro ao atualizar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Portal Químico</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

    <?php include "header.php"; ?>

    <div class="container" style="margin-top:40px;">
        <h4 class="center blue-text text-darken-2">
            <i class="material-icons">edit</i>
            Editar Usuário "<?php echo $usuario['usuario']; ?>"
        </h4>

        <?php if ($mensagem): ?>
            <div class="card-panel green lighten-4 center"><strong><?php echo $mensagem; ?></strong></div>
        <?php endif; ?>

        <?php if ($erro): ?>
            <div class="card-panel red lighten-4 center"><strong><?php echo $erro; ?></strong></div>
        <?php endif; ?>

        <div class="row">
            <form method="POST" class="col s12 m8 offset-m2">
                <div class="input-field">
                    <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario['usuario']); ?>" required>
                    <label>Nome de Usuário</label>
                </div>

                <div class="input-field">
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                    <label>E-mail</label>
                </div>

                <div class="input-field">
                    <select name="tipo" required>
                        <option value="user" <?php echo $usuario['tipo'] === 'user' ? 'selected' : ''; ?>>Usuário Comum</option>
                        <option value="admin" <?php echo $usuario['tipo'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                    </select>
                    <label>Tipo de Usuário</label>
                </div>

                <div class="center" style="margin-top:30px;">
                    <button type="submit" class="btn-large waves-effect waves-light blue">
                        <i class="material-icons left">save</i>
                        Salvar Alterações
                    </button>
                    <a href="usuariosadm.php" class="btn red lighten-1">
                        <i class="material-icons left">arrow_back</i>
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
</body>

</html>