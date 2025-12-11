<?php
include "conecta.php";
include "auth.php"; // garante sessão e auth

$id = $_GET['id'] ?? 0;
$id = (int)$id;

if ($id <= 0) {
    header("Location: forum.php");
    exit();
}

// Verifica se o usuário é admin (para responder)
$eh_admin = isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $eh_admin) {
    $conteudo = trim($_POST['conteudo'] ?? '');
    if (!empty($conteudo)) {
        $stmt = $pdo->prepare("INSERT INTO respostas (conteudo, pergunta_id, usuario_id) VALUES (?, ?, ?)");
        $stmt->execute([$conteudo, $id, $_SESSION['id_usuario']]);
        $mensagem = "Resposta enviada com sucesso!";
        // Limpa o campo
        $_POST['conteudo'] = '';
    } else {
        $mensagem = "Digite uma resposta.";
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
    <link rel="stylesheet" href="forum.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container section">
        <h4 class="center teal-text text-darken-2">Respostas da Pergunta #<?php echo $id; ?></h4>

        <?php if ($mensagem): ?>
            <div class="card-panel <?php echo $eh_admin ? 'green' : 'red'; ?> lighten-4 center">
                <strong><?php echo $mensagem; ?></strong>
            </div>
        <?php endif; ?>

        <!-- Lista todas as respostas (todos podem ver) -->
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
            echo '<p class="center grey-text">Ainda não há respostas. Aguarde a resposta do administrador.</p>';
        }
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card">
                    <div class="card-content">
                        <p>' . nl2br(htmlspecialchars($row['conteudo'])) . '</p>
                        <small>
                            Por: <strong>' . htmlspecialchars($row['usuario']) . '</strong> 
                            ' . ($row['tipo'] === 'admin' ? '<span class="red-text">(Administrador)</span>' : '') . '
                            em ' . date('d/m/Y H:i', strtotime($row['created_at'])) . '
                        </small>
                    </div>
                  </div>';
        }
        ?>

        <!-- Formulário de resposta: só aparece para admin -->
        <?php if ($eh_admin): ?>
            <div class="card" style="margin-top:30px;">
                <div class="card-content">
                    <h5>Responder como Administrador</h5>
                    <form method="POST">
                        <div class="input-field">
                            <textarea name="conteudo" class="materialize-textarea" required 
                                      placeholder="Escreva a resposta oficial aqui..."><?php echo $_POST['conteudo'] ?? ''; ?></textarea>
                            <label>Resposta</label>
                        </div>
                        <div class="center">
                            <button type="submit" class="btn-large waves-effect waves-light teal">
                                <i class="material-icons left">send</i>
                                Enviar Resposta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="card-panel yellow lighten-4 center">
                <strong>Atenção:</strong> Apenas administradores podem responder no fórum.<br>
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

    <script src="js/materialize.min.js"></script>
</body>
</html>