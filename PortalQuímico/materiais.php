<?php
include "conecta.php";
include "auth.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais - Portal Químico</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="materiais.css">
</head>

<body>
    <?php include "header.php"; ?>
    <div class="page-header">
        <div class="container">
            <h3 class="center" style="margin:0; font-size:2.8rem;">
                Materiais Didáticos de Química
            </h3>
            <p class="center" style="margin-top:0.5rem; opacity:0.9;">
                Inclui: Materiais para estudo, auxílio na criação de aulas acessíveis e exercícios
            </p>

            <div class="search-box">
                <div class="input-field">
                    <input type="text" id="search" placeholder="Buscar materiais..." class="white grey-text text-darken-3">
                </div>
            </div>
        </div>
    </div>

    <div class="container section">
        <div class="row" id="materiais-grid">
            <?php
            $sql = "SELECT id_material, nome, descricao, material FROM materiais ORDER BY id_material DESC";
            $resultado = $conn->query($sql);

            if ($resultado && $resultado->num_rows > 0):
                while ($row = $resultado->fetch_assoc()):
                    $arquivo = $row['material'];
                    $caminho = "materiais/" . $arquivo;
                    $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

                    $icone = 'description';
                    if (in_array($extensao, ['pdf'])) $icone = 'picture_as_pdf';
                    if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) $icone = 'image';
                    if (in_array($extensao, ['mp4', 'avi', 'mov'])) $icone = 'video_file';
            ?>
                    <div class="col s12 m6 l4 material-item">
                        <div class="card material-card hoverable">
                            <div class="card-content center">
                                <i class="material-icons large file-icon"><?php echo $icone; ?></i>
                                <h5 class="grey-text text-darken-3" style="margin:15px 0 8px;">
                                    <?php echo htmlspecialchars($row['nome']); ?>
                                </h5>
                                <p class="grey-text" style="font-size:0.95rem; min-height:50px;">
                                    <?php echo htmlspecialchars($row['descricao'] ?: 'Sem descrição'); ?>
                                </p>
                            </div>
                            <div class="card-action center" style="padding:15px;">
                                <a href="<?php echo $caminho; ?>" target="_blank"
                                    class="btn blue darken-1 waves-effect waves-light">
                                    <i class="material-icons left">download</i> visualizar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
            else:
                ?>
                <div class="col s12 center">
                    <p class="grey-text" style="font-size:1.2rem;">Nenhum material enviado ainda.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.Sidenav.init(document.querySelectorAll('.sidenav'));

            const searchInput = document.getElementById('search');
            const items = document.querySelectorAll('.material-item');

            searchInput.addEventListener('keyup', function() {
                const termo = this.value.toLowerCase();
                items.forEach(item => {
                    const texto = item.textContent.toLowerCase();
                    item.style.display = texto.includes(termo) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>