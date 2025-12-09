<?php include "conecta.php"; ?>
<?php include "auth.php"; ?>

<?php
// Faz a conexão com o banco de dados


// Verifica se o formulário foi enviado via POST
if ($_POST) {

    // Pega a mensagem do formulário
    $comentario = $_POST['comentario'];

    // Valida se a mensagem não está vazia
    if (!empty($comentario)) {

        // Prepara o comando SQL 
        $sql = "INSERT INTO comentario (comentario, id_usuario) VALUES ('$comentario', '$id_usuario')";

        // Executa o comando SQL no banco
        if (mysqli_query($conexao, $sql)) {
            // Redireciona de volta para a página principal após inserir no banco
            header("location: index.php");
        }
    } else {
        echo "A mensagem não pode ser vazia. <br><a href='index.php'>Voltar</a>";
    }
} else {
    // Se não for um POST, redireciona para a página principal
    header("location: index.php");
}
