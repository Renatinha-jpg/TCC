<?php include "conecta.php"; ?>
<?php include "auth.php"; ?>

<?php
if ($_POST) {
    $comentario = $_POST['comentario'];

    if (!empty($comentario)) {
        $sql = "INSERT INTO comentario (comentario, id_usuario) VALUES ('$comentario', '$id_usuario')";
        if (mysqli_query($conexao, $sql)) {

            header("location: index.php");
        }
    } else {
        echo "A mensagem não pode ser vazia. <br><a href='index.php'>Voltar</a>";
    }
} else {
    header("location: index.php");
}
