<?php
include "conecta.php";
include "auth.php";
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo'] === 'admin') {
    header("Location: forum.php");
    exit();
}

$mensagem = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmado'])) {
    $titulo   = trim($_POST['titulo'] ?? '');
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (empty($titulo)) {
        $erro = "O título é obrigatório.";
    } elseif (strlen($titulo) < 10) {
        $erro = "O título deve ter pelo menos 10 caracteres.";
    } elseif (empty($conteudo)) {
        $erro = "O conteúdo da pergunta é obrigatório.";
    } elseif (strlen($conteudo) < 10) {
        $erro = "A pergunta deve ter pelo menos 10 caracteres.";
    } else {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO perguntas (titulo, conteudo, usuario_id, created_at) 
                VALUES (?, ?, ?, NOW())
            ");
            $stmt->execute([$titulo, $conteudo, $_SESSION['id_usuario']]);

            $mensagem = "Pergunta enviada com sucesso! Aguarde a resposta do administrador.";
            $titulo = $conteudo = "";
        } catch (Exception $e) {
            $erro = "Erro ao enviar pergunta. Tente novamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Pergunta - Portal Químico</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pergunta.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="page-header">
        <div class="container">
            <h1 style="margin:0; font-size:3.5rem; font-weight:700;">
                Faça sua Pergunta
            </h1>
            <p style="font-size:1.3rem; opacity:0.9; margin-top:15px;">
                Tire suas dúvidas! O administrador responderá em breve.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="form-box">
            <?php if ($mensagem): ?>
                <div class="card-panel green lighten-4 center-align">
                    <i class="material-icons left">check_circle</i>
                    <strong><?php echo $mensagem; ?></strong>
                </div>
            <?php endif; ?>

            <?php if ($erro): ?>
                <div class="card-panel red lighten-4 center-align">
                    <i class="material-icons left">error</i>
                    <strong><?php echo $erro; ?></strong>
                </div>
            <?php endif; ?>

            <form id="formPergunta" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">title</i>
                        <input type="text" name="titulo" id="titulo" required
                            value="<?php echo htmlspecialchars($_POST['titulo'] ?? ''); ?>"
                            class="validate" maxlength="150">
                        <label for="titulo">Título da Pergunta *</label>
                        <span class="helper-text">Mínimo 10 caracteres</span>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">chat</i>
                        <textarea name="conteudo" id="conteudo" class="materialize-textarea" required
                            data-length="2000"><?php echo htmlspecialchars($_POST['conteudo'] ?? ''); ?></textarea>
                        <label for="conteudo">Sua Pergunta *</label>
                        <span class="helper-text">Descreva bem sua dúvida (mínimo 10 caracteres)</span>
                    </div>
                </div>

                <div class="center">
                    <button type="button" id="btnAbrirModal" class="btn-large blue waves-effect waves-light blue darken-1">
                        <i class="material-icons left">send</i>
                        Enviar Pergunta
                    </button>
                    <a href="forum.php" class="btn-large grey waves-effect waves-light">
                        <i class="material-icons left">arrow_back</i>
                        Voltar ao Fórum
                    </a>
                </div>
                <input type="hidden" name="confirmado" value="1">
            </form>
        </div>
    </div>

    <div id="modalConfirmar" class="modal">
        <div class="modal-content">
            <h4>Confirmar Envio</h4>
            <p>Você está prestes a enviar a seguinte pergunta. Deseja continuar?</p>
            <div class="preview-title" id="previewTitulo"></div>
            <div class="preview-content" id="previewConteudo"></div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
            <button type="submit" form="formPergunta" class="btn blue waves-effect waves-light">
                <i class="material-icons left">check</i> Confirmar e Enviar
            </button>
        </div>
    </div>

    <script src="js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.updateTextFields();
            M.CharacterCounter.init(document.querySelectorAll('textarea'));
            M.textareaAutoResize(document.getElementById('conteudo'));

            var modal = M.Modal.init(document.getElementById('modalConfirmar'));

            document.getElementById('btnAbrirModal').addEventListener('click', function() {
                var titulo = document.getElementById('titulo').value.trim();
                var conteudo = document.getElementById('conteudo').value.trim();

                if (titulo === '' || conteudo === '') {
                    M.toast({
                        html: 'Preencha título e pergunta antes de enviar.',
                        classes: 'red'
                    });
                    return;
                }

                document.getElementById('previewTitulo').textContent = titulo;
                document.getElementById('previewConteudo').textContent = conteudo;

                modal.open();
            });
        });
    </script>
</body>

</html>