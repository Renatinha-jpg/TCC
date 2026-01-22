<?php
session_start();
include_once "conecta.php";
include_once "auth.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST) && empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) {
        $erro = "O arquivo enviado é muito grande. O limite do servidor é menor que o tamanho do arquivo. Tente um arquivo de até 30 MB (ou menor, dependendo da configuração do servidor).";
    }
}

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'] ?? 0;
$id = (int)$id;

if ($id <= 0) {
    die("ID inválido.");
}

$stmt = $conn->prepare("SELECT id_material, nome, descricao, material FROM materiais WHERE id_material = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$material = $result->fetch_assoc()) {
    die("Material não encontrado.");
}

$mensagem = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_nome = trim($_POST['nome'] ?? '');
    $nova_desc = trim($_POST['descricao'] ?? '');

    if (empty($novo_nome)) {
        $erro = "O título é obrigatório.";
    } else {
        $novo_arquivo_nome = $material['material'];

        if (!empty($_FILES['arquivo']['name'])) {
            $tamanhoMax = 30 * 1024 * 1024;
            if ($_FILES['arquivo']['size'] > $tamanhoMax) {
                $erro = "Arquivo muito grande (máx. 30 MB).";
            } else {
                $pasta = __DIR__ . "/materiais/";
                if (!is_dir($pasta)) mkdir($pasta, 0777, true);

                $ext = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
                $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'];
                $mimePermitidos = [
                    'image/jpeg',
                    'image/jpg',
                    'image/png',
                    'image/gif',
                    'image/webp',
                    'application/pdf'
                ];

                $mime = mime_content_type($_FILES['arquivo']['tmp_name']);
                $extOk = in_array($ext, $tiposPermitidos);
                $mimeOk = in_array($mime, $mimePermitidos);

                if ($extOk && ($mimeOk || $mime === 'application/octet-stream')) {
                    $novo_nome_arquivo = md5(time() . rand(0, 99999)) . '.' . $ext;
                    $destino = $pasta . $novo_nome_arquivo;

                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino)) {
                        @unlink($pasta . $material['material']);
                        $novo_arquivo_nome = $novo_nome_arquivo;
                    } else {
                        $erro = "Falha ao salvar o novo arquivo.";
                    }
                } else {
                    $erro = "Tipo de arquivo não permitido.";
                }
            }
        }

        if (empty($erro)) {
            $stmt = $conn->prepare("UPDATE materiais SET nome = ?, descricao = ?, material = ? WHERE id_material = ?");
            $stmt->bind_param("sssi", $novo_nome, $nova_desc, $novo_arquivo_nome, $id);

            if ($stmt->execute()) {
                $mensagem = "Material atualizado com sucesso!";
                $material['nome'] = $novo_nome;
                $material['descricao'] = $nova_desc;
                $material['material'] = $novo_arquivo_nome;
            } else {
                $erro = "Erro ao salvar no banco.";
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
    <title>Alterar Material - Portal Químico</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
        }

        .edit-box {
            max-width: 750px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .current-file {
            background: #e0f2f1;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <?php include "header.php"; ?>

    <div class="container">
        <div class="edit-box">
            <h4 class="center blue-text text-darken-2">
                <i class="material-icons">edit</i>
                Editar Material
            </h4>

            <?php if ($mensagem): ?>
                <div class="card-panel green lighten-4 center"><strong><?php echo $mensagem; ?></strong></div>
            <?php endif; ?>
            <?php if ($erro): ?>
                <div class="card-panel red lighten-4 center"><strong><?php echo $erro; ?></strong></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="31457280"> 
                <div class="input-field">
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($material['nome']); ?>" required>
                    <label>Título do Material</label>
                </div>

                <div class="input-field">
                    <textarea name="descricao" class="materialize-textarea"><?php echo htmlspecialchars($material['descricao']); ?></textarea>
                    <label>Descrição</label>
                </div>

                <div class="current-file">
                    <strong>Arquivo atual:</strong><br>
                    <a href="materiais/<?php echo $material['material']; ?>" target="_blank">
                        <?php echo $material['material']; ?> (abrir)
                    </a>
                </div>

                <div class="file-field input-field">
                    <div class="btn blue">
                        <span>Novo Arquivo (opcional)</span>
                        <input type="file" name="arquivo" accept=".pdf,.jpg,.jpeg,.png,.gif,.webp">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Deixe em branco para manter o atual">
                    </div>
                </div>

                <div class="center" style="margin-top:30px;">
                    <button type="submit" class="btn-large waves-effect waves-light blue">
                        <i class="material-icons left">save</i>
                        Salvar Alterações
                    </button>
                    <a href="materiaisadm.php" class="btn red lighten-1">
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
            M.updateTextFields();
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    M.updateTextFields();

    const form = document.querySelector('form');
    const fileInput = document.querySelector('input[type="file"]');

    form.addEventListener('submit', function(e) {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const maxSize = 30 * 1024 * 1024;

            if (file.size > maxSize) {
                e.preventDefault();
                M.toast({
                    html: 'Erro: O arquivo excede o tamanho máximo de 30 MB.',
                    classes: 'red rounded'
                });
            }
        }
    });
});
</script>
</body>

</html>