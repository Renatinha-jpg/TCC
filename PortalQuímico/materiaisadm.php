<?php
include_once "auth.php";
include_once "conecta.php";
include_once "header.php";

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Materiais - Portal Químico</title>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .container {
            margin-bottom: 50px;
        }
    </style>
    <div class="container">
        <h3 class="center blue-text text-darken-2">Gerenciar Materiais</h3>
        <a href="uploadmateriais.php" class="btn-floating btn-large waves-effect waves-light blue right" title="Enviar novo">
            <i class="material-icons">add</i>
        </a>

        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id_material, nome, descricao, material FROM materiais ORDER BY id_material DESC";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0):
                    while ($mat = $resultado->fetch_assoc()):
                        $arquivo = $mat['material'];
                        $ext = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
                        $icone = $ext === 'pdf' ? 'picture_as_pdf' : 'image';
                ?>
                        <tr>
                            <td>
                                <i class="material-icons"><?php echo $icone; ?></i>
                                <a href="materiais/<?php echo $arquivo; ?>" target="_blank">
                                    <?php echo htmlspecialchars($mat['nome']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($mat['nome']); ?></td>
                            <td><?php echo htmlspecialchars($mat['descricao'] ?: 'Sem descrição'); ?></td>
                            <td>
                                <a href="alterar.php?id=<?php echo $mat['id_material']; ?>"
                                    class="btn-floating waves-effect waves-light blue tooltipped"
                                    data-position="top" data-tooltip="Editar">
                                    <i class="material-icons">edit</i>
                                </a>


                                <a href="#modal<?php echo $mat['id_material']; ?>" class="btn-floating waves-effect waves-light red modal-trigger">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>


                        <div id="modal<?php echo $mat['id_material']; ?>" class="modal">
                            <div class="modal-content">
                                <h3>Atenção!</h3>
                                <p>Tem certeza que deseja <strong>excluir permanentemente</strong> o material:</p>
                                <p class="blue-text text-darken-2"><b>"<?php echo htmlspecialchars($mat['nome']); ?>"</b></p>
                                <p class="red-text">Esta ação <strong>não pode ser desfeita</strong>.</p>
                            </div>
                            <div class="modal-footer">
                                <form action="deletar.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $mat['id_material']; ?>">
                                    <button type="submit" class="btn green waves-effect waves-light">
                                        <i class="material-icons left">delete_forever</i> Sim, Excluir
                                    </button>
                                </form>
                                <a href="#!" class="modal-close btn red waves-effect waves-light" style="margin-left:10px;">
                                    <i class="material-icons left">cancel</i> Cancelar
                                </a>
                            </div>
                        </div>

                <?php
                    endwhile;
                else:
                    echo '<tr><td colspan="4" class="center grey-text">Nenhum material encontrado.</td></tr>';
                endif;
                ?>
            </tbody>
        </table>
    </div>


    <script src="js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            M.Modal.init(elems, {
                opacity: 0.8,
                inDuration: 300,
                outDuration: 200
            });
        });
    </script>
</body>

</html>