<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar novo arquivos</title>
</head>
<body>
    <form action="cadastrar.php" method="post" enctype="multipart/form-data">
        <label>Nome: <input type="text" name="nome"> </label> <br>
        <label>Selecione o arquivo: <input type ="file" name="arquivo"> </label> <br>
        <input type="submit" value="Salvar">
    </form>
</html>