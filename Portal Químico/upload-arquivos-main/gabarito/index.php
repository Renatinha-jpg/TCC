<?php
session_start();
$id = filter_input(INPUT_GET, 'id');

$conexao = mysqli_connect("localhost", "root", "", "upload");
$sql = "SELECT * FROM arquivo";
$resultSet = mysqli_query($conexao, $sql);
$arquivos = mysqli_fetch_all($resultSet, MYSQLI_ASSOC);

if (!is_null($id)) {
    $sql2 = "SELECT * FROM arquivo WHERE id_arquivo = $id";
    $resultSet2 = mysqli_query($conexao, $sql2);
    $arq = mysqli_fetch_assoc($resultSet2);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de arquivo</title>
</head>

<body>
    <div style="color: red;"><?php
                                if (isset($_SESSION['mensagem'])) {
                                    echo $_SESSION['mensagem'];
                                    unset($_SESSION['mensagem']);
                                }
                                ?></div>
    <form action="salvar.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="id_arquivo" value="<?= is_null($id) ? '' : $arq['id_arquivo'] ?>"><br>
        <label>Escolha o arquivo do computador:
            <input type="file" name="arquivo">
        </label><br>
        <input type="submit" value="Enviar">
    </form>
    <br><br>
    <?php
    foreach ($arquivos as $arquivo) {
        echo "<a href='uploads/"
            . $arquivo['nome']
            . "'>"
            . $arquivo['nome']
            . "</a> <a href='index.php?id="
            . $arquivo['id_arquivo']
            . "'>Alterar</a> "
            . "<a href='excluir.php?id="
            . $arquivo['id_arquivo']
            . "'>Excluir</a><br>";
    }
    ?>
</body>

</html>