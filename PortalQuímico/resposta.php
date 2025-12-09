<?php include "conecta.php"; 
include "auth.php";

if (!isset($_SESSION['user_id'])) header("Location: login.php"); 
$id = $_GET['id']; ?>
<?php include 'header.php'; ?>

<h3>Respostas</h3>
<?php
// Lista respostas
$stmt = $pdo->prepare("SELECT r.*, u.nome FROM respostas r JOIN usuarios u ON r.usuario_id = u.id WHERE pergunta_id = ?");
$stmt->execute([$id]);
while ($row = $stmt->fetch()) {
    echo "<div class='card'><div class='card-content'><p>{$row['conteudo']}</p><small>Por: {$row['nome']}</small></div></div>";
}
?>

<form method="POST">
    <textarea name="conteudo" placeholder="Sua resposta" required></textarea>
    <button type="submit" class="btn">Responder</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conteudo = $_POST['conteudo'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO respostas (conteudo, pergunta_id, usuario_id) VALUES (?, ?, ?)");
    $stmt->execute([$conteudo, $id, $user_id]);
    header("Location: resposta.php?id=$id");
}
?>
