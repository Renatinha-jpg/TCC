<?php
include "conecta.php";
include "auth.php";
$eh_admin = isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin';
$usuario_logado = isset($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - Portal Químico</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="forum.css">
</head>

<body>
    <?php include 'header.php'; ?>

    
    <div class="page-header center blue white-text" style="padding:88px;">
        <h3 style="margin:0; font-size:2.8rem;">Possui Perguntas? Pergunte Aqui!</h3>
        <p style="margin:0; font-size:1.2rem;">Nosso administrador responderá o mais breve possível.</p>
    </div>
    <div class="container section">
        <div class="center">
           <?php if ($usuario_logado && !$eh_admin): ?>
        <a href="pergunta.php" class="btn-floating btn-large waves-effect waves-light blue fixed-btn pulse">
            <i class="material-icons">add</i>
        </a>
        <?php endif; ?>
        </div>
        <?php
        if (isset($_GET['deletada'])) {
            if ($_GET['deletada'] == 1) {
                echo '<div class="center green-text"><strong>Pergunta excluída com sucesso!</strong></div>';
            } else {
                echo '<div class="center red-text"><strong>Erro ao excluir a pergunta.</strong></div>';
            }
        }
        ?>


        <?php
        $stmt = $pdo->query("
            SELECT p.id_perguntas, p.titulo, p.conteudo, p.created_at, u.usuario, u.tipo as usuario_tipo
            FROM perguntas p 
            JOIN usuarios u ON p.usuario_id = u.id_usuario 
            ORDER BY p.created_at DESC
        ");

        if ($stmt->rowCount() == 0):
            echo '<div class="center"><h5 class="grey-text">Nenhuma pergunta ainda. Seja o primeiro!</h5></div>';
        endif;

        while ($pergunta = $stmt->fetch(PDO::FETCH_ASSOC)):
            $data = date('d/m/Y \à\s H:i', strtotime($pergunta['created_at']));
        ?>
            <div class="card question-card">
                <div class="card-content">
                    <span class="card-title blue-text text-darken-2">
                        <?php echo htmlspecialchars($pergunta['titulo']); ?>
                    </span>
                    <p><?php echo nl2br(htmlspecialchars($pergunta['conteudo'])); ?></p>
                    <small class="grey-text">
                        Por: <strong><?php echo htmlspecialchars($pergunta['usuario']); ?></strong>
                        <?php if ($pergunta['usuario_tipo'] === 'admin'): ?>
                            <span class="new badge red" data-badge-caption="ADMIN"></span>
                        <?php endif; ?>
                        em <?php echo $data; ?>
                    </small>

                    <?php
                    $stmt_res = $pdo->prepare("
                    SELECT r.id_respostas, r.conteudo, r.created_at, u.usuario, u.tipo 
                    FROM respostas r 
                    JOIN usuarios u ON r.usuario_id = u.id_usuario 
                    WHERE r.pergunta_id = ? 
                    ORDER BY r.created_at ASC
                ");
                    $stmt_res->execute([$pergunta['id_perguntas']]);
                    $respostas = $stmt_res->fetchAll(PDO::FETCH_ASSOC);

                    if (count($respostas) > 0):
                        foreach ($respostas as $resp):
                            $data_resp = date('d/m/Y H:i', strtotime($resp['created_at']));
                    ?>
                            <div class="resposta-card card <?php echo $resp['tipo'] === 'admin' ? 'admin-resposta' : ''; ?>">
                                <div class="card-content">
                                    <p><?php echo nl2br(htmlspecialchars($resp['conteudo'])); ?></p>
                                    <small class="grey-text">
                                        Por: <strong><?php echo htmlspecialchars($resp['usuario']); ?></strong>
                                        <?php if ($resp['tipo'] === 'admin'): ?>
                                            <span class="new badge red" data-badge-caption="OFICIAL"></span>
                                        <?php endif; ?>
                                        em <?php echo $data_resp; ?>
                                    </small>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    else:
                        echo '<div class="center grey-text" style="margin:20px 0;"><em>Aguardando resposta do administrador...</em></div>';
                    endif;
                    ?>
                    
                    <?php if ($eh_admin): ?>
                                <a href="#modalExcluir"
                                    class="modal-trigger right red-text tooltipped" 
                                    style="padding-top:10px;"
                                    data-position="left"
                                    data-tooltip="Excluir pergunta"
                                    data-pergunta-id="<?php echo $pergunta['id_perguntas']; ?>">
                                    <i class="material-icons small">delete</i>
                                </a>
                            <?php endif; ?>

                    <div style="margin-top:20px;">
                        <?php if ($eh_admin): ?>
                            <a href="resposta.php?id=<?php echo $pergunta['id_perguntas']; ?>"
                                class="btn blue waves-effect waves-light">
                                <i class="material-icons left">reply</i>
                                Responder
                            </a>
                        <?php else: ?>
                            <em class="grey-text">Aguarde a resposta do administrador.</em>
                        <?php endif; ?>
                        <span class="card-title blue-text text-darken-2">

                            
                        </span>
                    </div>

                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div id="modalExcluir" class="modal">
        <div class="modal-content">
            <h4>Excluir Pergunta</h4>
            <p>Tem certeza que deseja <strong>excluir permanentemente</strong> esta pergunta e todas as suas respostas?</p>
            <p class="red-text"><strong>Esta ação não pode ser desfeita.</strong></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancelar</a>
            <a href="#" id="btnConfirmarExclusao" class="waves-effect waves-green btn green">
                <i class="material-icons left">delete_forever</i> Excluir
            </a>
        </div>
    </div>

    <script src="js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modals = document.querySelectorAll('.modal');
            M.Modal.init(modals);

            var tooltips = document.querySelectorAll('.tooltipped');
            M.Tooltip.init(tooltips);

            document.querySelectorAll('.modal-trigger').forEach(function(trigger) {
                trigger.addEventListener('click', function() {
                    var perguntaId = this.getAttribute('data-pergunta-id');
                    var btnConfirmar = document.getElementById('btnConfirmarExclusao');

                    btnConfirmar.href = 'excluirpergunta.php?id=' + perguntaId;
                });
            });
        });
    </script>

</body>

</html>