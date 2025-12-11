

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais Administrador</title>
    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php 
    include_once "auth.php";
    include_once "header.php" ;
    include_once "conecta.php";
?>

<h3> Materiais </h3>

<?php
$conn = mysqli_connect("localhost", "root", "", "quimica");
$sql = "SELECT * FROM materiais";
$resultado = mysqli_query($conn, $sql);
if ($resultado != false) {
    $arquivos = mysqli_fetch_all($resultado, MYSQLI_BOTH);
} else {
    echo "Erro ao executar comando SQL.";
    die();
}
?>
<input type="button" value="Enviar Novo Material" onclick="window.location.href='uploadmateriais.php'">
    </form>
    <br><br>
    <table>
        <thead>
            <tr>
                <th colspan="2">Arquivo</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($arquivos as $arquivo) {
                $arq = $arquivo['nome'];
                echo "<tr>"; // iniciar a linha
                echo "<td><img src='materiais/$arq' width='100px' height='100px'></td>"; // exibe imagem
              echo "<td><a href='materiais/{$arquivo['material']}' target='_blank'>{$arquivo['nome']}</a></td>";
                echo "<td>"; // iniciar a 2ª coluna
                echo "<a "; // abriu o link (abriu a tag a)
                echo "href='alterar.php?nome=$arq'>"; // inseriu o link
                echo "Alterar"; // imprimiu o texto da tag a
                echo "</a>"; // fechei a tag a (fechei o link)
                echo "</td>"; // fechei a 2ª coluna

               echo "<td>
    <button class='btn red waves-effect waves-light' 
            onclick='excluir(\"{$arquivo['material']}\")'>
        <i class='material-icons'>delete</i> Excluir
    </button>
</td>";
                echo "</tr>"; // fechar a linha
            }
            ?>
        </tbody>
    </table>

    <script>
        function excluir(nome_arquivo) {
    if (confirm("Tem certeza que deseja excluir este material?")) {
        window.location.href = "deletar.php?arquivo=" + encodeURIComponent(nome_arquivo);
    }
}
    </script>
</body>
</html>