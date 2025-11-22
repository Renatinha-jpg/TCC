<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural de Recados</title>
</head>
<body>

    <h1>Mural de Recados</h1>

    <h2>Deixe sua mensagem:</h2>
    <form action="processa.php" method="POST">
        <textarea name="mensagem" rows="5" placeholder="Escreva sua mensagem aqui..." required></textarea> <br>
        <input type="submit" value="Publicar Mensagem">
    </form>

    <hr>

    <h2>Recados Postados:</h2>
    <?php
    // Faz a conexão com o banco
    include 'conecta.php';

    // Seleciona todos os recados do banco, ordenados do mais novo para o mais antigo
    $sql = "SELECT * FROM comentario ORDER BY data_postagem DESC";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se há recados
    if (mysqli_num_rows($resultado) > 0) {

        // Exibe cada um dos recados
        while ($linha = mysqli_fetch_assoc($resultado)) {

            // Formata a data e hora para um formato mais amigável...
            $dataFormatada = date('d/m/Y H:i:s', strtotime($linha['data_postagem']));

            echo '<p> Postado em: ' . $dataFormatada . '<br>';
            echo '<p>' . $linha['mensagem'] . '</p> <hr>';
        }

    } else { // se ainda não houver recados..
        echo '<p> Nenhuma pergunta ainda.</p>';
    }

    ?>
</body>
</html>