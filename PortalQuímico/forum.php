<?php include "auth.php"; ?>
<?php include "conecta.php"; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="forum.css">
    <title>Fórum - Portal Químico</title>

</head>
<body>
    <?php include 'header.php'; ?>

   <!-- Header -->
    <div class="page-header">
        <div class="container">
            <h3 class="center" style="margin:0; font-size:2.8rem;">
                Possui Perguntas? Pergunte Aqui!
            </h3>
            <p class="center" style="font-size:1.2rem; color:#fff;">
                Tire suas dúvidas com a comunidade do Portal Químico.   
            </p>
<div class="search-box">
                <div class="input-field">
                    <input type="text" id="search" placeholder="Buscar" class="white grey-text text-darken-3">
                </div>
            </div>
        </div>
    </div>

    <div class="container section">
        <?php
        // Consulta corrigida e testada
       $stmt = $pdo->query("
    SELECT p.id_perguntas, p.titulo, p.conteudo, p.created_at, u.usuario 
    FROM perguntas p 
    JOIN usuarios u ON p.usuario_id = u.id_usuario 
    ORDER BY p.created_at DESC
");

        if ($stmt->rowCount() == 0) {
            echo '<p class="no-questions">Ainda não há perguntas no fórum. Seja o primeiro a perguntar!</p>';
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Formata a data para ficar bonito (ex: 09/12/2025 às 20:15)
            $data = date('d/m/Y à\s H:i', strtotime($row['created_at']));
            
            echo '<div class="card">
                    <div class="card-content">
                        <span class="card-title">' . htmlspecialchars($row['titulo']) . '</span>
                        <p>' . nl2br(htmlspecialchars($row['conteudo'])) . '</p>
                        <small>Por: <strong>' . htmlspecialchars($row['usuario']) . '</strong> em ' . $data . '</small>
                        <div style="margin-top:15px;">
                            <a href="resposta.php?id=' . $row['id_perguntas'] . '" class="btn btn-responder waves-effect waves-light">
                                <i class="material-icons left">reply</i> Responder
                            </a>
                        </div>
                    </div>
                  </div>';
        }
        ?>
        
        <div class="center" style="margin-top:40px;">
            <a href="pergunta.php" class="btn-large waves-effect waves-light" style="background:#4fa1eb; border-radius:50px;">
                <i class="material-icons left">add</i> Fazer uma nova pergunta
            </a>
        </div>
    </div>

    <script src="js/materialize.min.js"></script>
</body>
</html>