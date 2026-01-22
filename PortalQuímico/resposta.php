<?php
include "conecta.php";
include "auth.php";

$id = $_GET['id'] ?? 0;
$id = (int)$id;
$titulo = $_GET['titulo'] ?? '';

if ($id <= 0) {
    header("Location: forum.php");
    exit();
}

$eh_admin = isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
$mensagem = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $eh_admin && isset($_POST['confirmado'])) {
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (empty($conteudo)) {
        $erro = "Digite uma resposta antes de enviar.";
    } elseif (strlen($conteudo) < 10) {
        $erro = "A resposta deve ter pelo menos 10 caracteres.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO respostas (conteudo, pergunta_id, usuario_id, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$conteudo, $id, $_SESSION['id_usuario']]);
            $mensagem = "Resposta enviada com sucesso!";
            $conteudo = "";
        } catch (Exception $e) {
            $erro = "Erro ao enviar resposta. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respostas - Portal Químico</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="pergunta.css">
    <style>
        .preview-content {
            background: #f5f7fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            white-space: pre-wrap;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container section">
        <h4 class="center blue-text text-darken-2">Respostas da Pergunta: <?php echo htmlspecialchars($titulo); ?></h4>

        <?php if ($mensagem): ?>
            <div class="card-panel green lighten-4 center">
                <strong><?php echo $mensagem; ?></strong>
            </div>
        <?php endif; ?>

        <?php if ($erro): ?>
            <div class="card-panel red lighten-4 center">
                <i class="material-icons left">error</i>
                <strong><?php echo $erro; ?></strong>
            </div>
        <?php endif; ?>

        <?php
        $stmt = $pdo->prepare("
            SELECT r.conteudo, r.created_at, u.usuario, u.tipo 
            FROM respostas r 
            JOIN usuarios u ON r.usuario_id = u.id_usuario 
            WHERE r.pergunta_id = ? 
            ORDER BY r.created_at ASC
        ");
        $stmt->execute([$id]);

        if ($stmt->rowCount() == 0) {
            echo '<p class="center grey-text">Ainda não há respostas.</p>';
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card">
                    <div class="card-content">
                        <p>' . nl2br(htmlspecialchars($row['conteudo'])) . '</p>
                        <small>
                            Por: <strong>' . htmlspecialchars($row['usuario']) . '</strong> 
                            ' . ($row['tipo'] === 'admin' ? '<span class="new badge red" data-badge-caption="OFICIAL"></span>' : '') . '
                            em ' . date('d/m/Y H:i', strtotime($row['created_at'])) . '
                        </small>
                    </div>
                  </div>';
        }
        ?>

        <?php if ($eh_admin): ?>
            <div class="card" style="margin-top:30px;">
                <div class="card-content">
                    <h5>Responder</h5>
                    <form id="formResposta" method="POST">
                        <div class="input-field">
                            <textarea name="conteudo" id="conteudo" class="materialize-textarea" required
                                placeholder="Escreva a resposta oficial aqui..." data-length="2000"><?php echo htmlspecialchars($_POST['conteudo'] ?? ''); ?></textarea>
                            <label for="conteudo">Resposta Oficial</label>
                            <span class="helper-text">Mínimo 10 caracteres</span>
                        </div>

                        <div class="center" style="margin-top: 20px;">
                            <button type="button" id="btnAbrirModal" class="btn-large blue waves-effect waves-light blue darken-1">
                                <i class="material-icons left">send</i>
                                Enviar Resposta
                            </button>
                        </div>
                        <input type="hidden" name="confirmado" value="1">
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="card-panel yellow lighten-4 center">
                <strong>Atenção:</strong> Apenas administradores podem responder perguntas.<br>
                Sua pergunta será respondida em breve!
            </div>
        <?php endif; ?>

        <div class="center" style="margin-top:30px;">
            <a href="forum.php" class="btn grey">
                <i class="material-icons left">arrow_back</i>
                Voltar ao Fórum
            </a>
        </div>
    </div>
    <div id="modalConfirmarResposta" class="modal">
        <div class="modal-content">
            <h4>Confirmar Resposta</h4>
            <p>Você está prestes a publicar esta resposta oficial. Deseja continuar?</p>

            <div class="preview-content" id="previewResposta"></div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
            <button type="submit" form="formResposta" class="btn blue waves-effect waves-light">
                <i class="material-icons left">check</i> Confirmar e Enviar
            </button>
        </div>
    </div>

    <script src="js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.textareaAutoResize(document.getElementById('conteudo'));
            M.CharacterCounter.init(document.querySelectorAll('textarea'));

            var modal = M.Modal.init(document.getElementById('modalConfirmarResposta'));

            document.getElementById('btnAbrirModal').addEventListener('click', function() {
                var conteudo = document.getElementById('conteudo').value.trim();

                if (conteudo === '' || conteudo.length < 10) {
                    M.toast({
                        html: 'A resposta deve ter pelo menos 10 caracteres.',
                        classes: 'red rounded'
                    });
                    return;
                }

                document.getElementById('previewResposta').textContent = conteudo;

                modal.open();
            });
        });
    </script>
</body>

</html>