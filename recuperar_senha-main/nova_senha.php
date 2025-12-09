<?php
$email = $_GET['email'];

require_once "conexao.php";
$conexao = conectar();
$sql = "SELECT * FROM usuario WHERE email='$email'";
$result = mysqli_query($conexao, $sql);
if ($result == false) {
    die("Erro ao executar o SQL. " . mysqli_error($conexao));
}
$recuperacao = mysqli_fetch_assoc($result);
if (is_null($recuperacao)) {
    die("Email inválidos, ou esta solicitação já foi utilizada");
}
date_default_timezone_set('America/Sao_Paulo');
$agora = new DateTime('now');
$data_criacao = DateTime::createFromFormat(
    'Y-m-d H:i:s',
    $recuperacao['data']
);
$umDia = DateInterval::createFromDateString('1 day');
$dataExpiracao = date_add($data_criacao, $umDia);

if ($agora > $dataExpiracao) {
    die("Essa solicitação de recuperação de senha expirou!
              Faça um novo pedido de recuperação de senha.");
}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha</title>
</head>

<body>
    <form action="salvar_nova_senha.php" method="post">
        <input type="hidden" name="email" value="<?= $email ?>">
        <label>Informe a nova senha: <input type="password" name="nova_senha"></label><br>
        <label>Repita a nova senha: <input type="password" name="nova_senha2"></label><br>
        <input type="submit" value="Salvar nova senha">
    </form>
</body>

</html>