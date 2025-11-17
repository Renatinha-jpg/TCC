<?php
require_once "conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM arquivo";
$result = executarSQL($conexao, $sql);
$arquivos = mysqli_fetch_all($result, MYSQLI_BOTH);

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de arquivos</title>
</head>
<body>
    <a href = "cadastrar_arquivos.php"> Cadastrar arquivo</a><br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Foto</th>
                <th>Opcoes</th>
            </tr>
        </thead>
    <tbody>
    <?php
    foreach($arquivos as $arquivo){
        echo '<tr>';
        echo '<td>' . $arquivo['id_arquivo'] . '</td>';
        echo '<td>' . $arquivo['nome'] . '</td>';
        echo '<td>' . 
        '<img width=200 src="./uploads/' . $arquivo['caminho'] . '">';
        echo '</td>';
                echo '<td><a href="excluir_arquivo.php?id=' . 
                $arquivo['id_arquivo'] . 
                '">Excluir</a></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
    </table>
</body>
</html>