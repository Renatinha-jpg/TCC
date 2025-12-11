<?php include "conecta.php"; 
include "auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="pergunta.css">
    
    <title>Forum - Portal Químico</title>
    
</head>
<body>
    <?php include 'header.php'; ?>
    <h3>Perguntas Recentes</h3>


<h3>Nova Pergunta</h3>
<form method="POST">
    <input type="text" name="titulo" placeholder="Título" required>
    <textarea name="conteudo" placeholder="Conteúdo" required></textarea>
    <button type="submit" class="btn">Postar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $user_id = $_SESSION['id_usuario'];

    $stmt = $pdo->prepare("INSERT INTO perguntas (titulo, conteudo, usuario_id) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $conteudo, $user_id]);
    header("Location: index.php");
}

// Para editar/excluir, adicione lógica similar com GET id (exercício para você expandir)
?>
</body>
</html>
