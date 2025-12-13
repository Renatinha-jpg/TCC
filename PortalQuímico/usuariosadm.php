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
    <title>Gerenciar Usuários - Portal Químico</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
</head>

<body>

    <main class="container">
        <h3 class="center blue-text text-darken-2">Gerenciar Usuários</h3>

        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Usuário</th>
                    <th>E-mail</th>
                    <th>Classe</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id_usuario, usuario, email, tipo FROM usuarios ORDER BY id_usuario DESC";
                $resultado = mysqli_query($conn, $sql);

                if (mysqli_num_rows($resultado) > 0):
                    while ($linha = mysqli_fetch_assoc($resultado)):
                ?>
                        <tr>
                            <td><?php echo $linha['id_usuario']; ?></td>
                            <td><?php echo htmlspecialchars($linha['usuario']); ?></td>
                            <td><?php echo htmlspecialchars($linha['email']); ?></td>
                            <td><?php echo $linha['tipo'] === 'admin' ? 'Administrador' : 'Usuário'; ?></td>
                            <td class="actions">
                                <a href="altuser.php?id=<?php echo $linha['id_usuario']; ?>"
                                    class="btn-floating waves-effect waves-light blue tooltipped"
                                    data-position="top" data-tooltip="Editar usuário">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="#modal<?php echo $linha['id_usuario']; ?>"
                                    class="btn-floating waves-effect waves-light red modal-trigger tooltipped"
                                    data-position="top" data-tooltip="Excluir usuário">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>

                        <div id="modal<?php echo $linha['id_usuario']; ?>" class="modal">
                            <div class="modal-content">
                                <h3>Atenção!</h3>
                                <p>Tem certeza que deseja <strong>excluir permanentemente</strong> o usuario:</p>
                                <p class="blue-text text-darken-2"><b>"<?php echo htmlspecialchars($linha['usuario']); ?>"</b></p>
                                <p class="red-text">Esta ação <strong>não pode ser desfeita</strong>.</p>
                            </div>
                            <div class="modal-footer">
                                <form action="excluirusuario.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $linha['id_usuario']; ?>">
                                    <button type="submit" class="btn green waves-effect waves-light">
                                        <i class="material-icons left">delete_forever</i> Sim, Excluir
                                    </button>
                                </form>
                                <a href="#!" class="modal-close btn red waves-effect waves-light" style="margin-left:10px;">
                                    <i class="material-icons left">cancel</i> Cancelar
                                </a>
                            </div>
                    <?php
                    endwhile;
                else:
                    echo '<tr><td colspan="5" class="center grey-text">Nenhum usuário encontrado.</td></tr>';
                endif;
                    ?>
            </tbody>
        </table>
    </main>

    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            M.Modal.init(elems, {
                opacity: 0.7,
                inDuration: 300,
                outDuration: 200
            });
            var tooltips = document.querySelectorAll('.tooltipped');
            M.Tooltip.init(tooltips);
        });
    </script>
</body>

</html>