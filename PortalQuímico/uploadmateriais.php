<?php
// uploadmateriais.php
include "auth.php";
include_once "conecta.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$mensagem = "";
$erro     = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    if (empty($nome)) {
        $erro = "O título do material é obrigatório.";
    } elseif (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {
        $erro = "Você precisa selecionar um arquivo válido.";
    } else {
        $arquivo       = $_FILES['arquivo'];
        $tamanhoMaximo = 30 * 1024 * 1024; // 30 MB
        $tiposPermitidos = [
            'application/pdf',
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/webp'
        ];

        if ($arquivo['size'] > $tamanhoMaximo) {
            $erro = "O arquivo excede o tamanho máximo de 30 MB.";
        } elseif (!in_array($arquivo['type'], $tiposPermitidos)) {
            $erro = "Tipo de arquivo não permitido. Apenas PDF e imagens são aceitos.";
        } else {
            // Diretório correto: pasta "materiais"
            $diretorioUpload = 'materiais/';
            if (!is_dir($diretorioUpload)) {
                mkdir($diretorioUpload, 0755, true);
            }

            // Gera nome único seguro
            $extensao   = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
            $nomeUnico  = md5(uniqid(rand(), true)) . '.' . $extensao;
            $caminhoFinal = $diretorioUpload . $nomeUnico;

            if (move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
                $stmt = $conn->prepare("INSERT INTO materiais (nome, descricao, material) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nome, $descricao, $nomeUnico);

                if ($stmt->execute()) {
                    $mensagem = "Material enviado com sucesso!";
                } else {
                    $erro = "Erro ao salvar no banco de dados.";
                    @unlink($caminhoFinal);
                }
                $stmt->close();
            } else {
                $erro = "Erro ao mover o arquivo para a pasta materiais.";
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
    <title>Upload de Material - Portal Químico</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body { background: #f5f7fa; }
        .upload-box { max-width: 700px; margin: 40px auto; padding: 30px; background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-large { background: #4fa1eb; border-radius: 50px; }
        
        /* Mensagem que some */
        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px 25px;
            background: #4caf50;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease;
        }
        .alert-success.show {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container">
    <div class="upload-box">
        <h4 class="center teal-text text-darken-2">
            Enviar Novo Material
        </h4>

        <!-- Mensagem de erro (permanece) -->
        <?php if ($erro): ?>
            <div class="card-panel red lighten-4 center">
                <strong><?= htmlspecialchars($erro) ?></strong>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <input type="text" name="nome" id="nome" required 
                       value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                <label for="nome">Título do Material *</label>
            </div>

            <div class="input-field">
                <textarea name="descricao" id="descricao" class="materialize-textarea"><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
                <label for="descricao">Descrição (opcional)</label>
            </div>

            <div class="file-field input-field">
                <div class="btn teal">
                    <span>Selecionar Arquivo</span>
                    <input type="file" name="arquivo" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp" required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="PDF ou imagem até 30 MB">
                </div>
            </div>

            <div class="center" style="margin-top:30px;">
                <button type="submit" class="btn-large waves-effect waves-light">
                    Enviar Material
                </button>
            </div>
        </form>

        <div class="center" style="margin-top:30px;">
            <a href="materiais.php" class="teal-text">
                Ver todos os materiais já enviados
            </a>
        </div>
    </div>
</div>

<!-- Mensagem flutuante de sucesso (some em 5s) -->
<?php if ($mensagem): ?>
<div class="alert-success" id="success-alert">
    <strong><?= htmlspecialchars($mensagem) ?></strong>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            // Mostra a mensagem
            setTimeout(() => alert.classList.add('show'), 100);

            // Esconde após 5 segundos
            setTimeout(() => {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 600); // remove do DOM após animação
            }, 5000);
        }
    });
</script>
<?php endif; ?>

<script src="js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        M.updateTextFields();
    });
</script>
</body>
</html>