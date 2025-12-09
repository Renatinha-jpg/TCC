<?php include "conecta.php"; ?>
<?php include "auth.php"; ?>
<?php
$host = 'localhost';
$db = 'quimica';
$user = 'root';
$pass = '';  // Mude se necessário

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="forum.css">
    
    <title>Forum - Portal Químico</title>
    
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="page-header">
        <div class="container">
            <h3 class="center" style="margin:0; font-size:2.8rem;">
                <h3>Perguntas Recentes</h3>
        </div>
    </div>

<div class="container section">
<?php
$stmt = $pdo->query("SELECT p.*, u.usuario FROM perguntas p JOIN usuarios u ON p.id = u.id_usuario ORDER BY created_at DESC");
while ($row = $stmt->fetch()) {
    echo "<div class='card'>
            <div class='card-content'>
                <span class='card-title'>{$row['titulo']}</span>
                <p>{$row['conteudo']}</p>
                <small>Por: {$row['usuario']} em {$row['created_at']}</small>
                <a href='resposta.php?id={$row['id_pergunta']}'>Responder</a>
            </div>
          </div>";
}
?>

</div>
</body>
</html>
