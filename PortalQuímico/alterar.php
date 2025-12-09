<?php
$nome = $_GET['nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Arquivo</title>
</head>

<body>
    <form action="uploadmateriais.php" method="post" enctype="multipart/form-data">
        Alterando o arquivo <?= $nome ?>:<br>
        <input type="hidden" name="nome" value="<?= $nome ?>">
        <input type="file" name="arquivo"><br>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>