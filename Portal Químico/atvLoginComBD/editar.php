<?php
$id = $_GET['id'];

include "conecta.php";

if ($_POST) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $nivel = $_POST['nivel'];

    if($_POST['senha'] == 's'){
        $senha = password_hash('teste123', PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios 
        SET nome = '$nome', usuario = '$usuario', senha = '$senha', nivel = $nivel
        WHERE id = $id";
        echo $sql;
    } else {
        $sql = "UPDATE usuarios 
        SET nome = '$nome', usuario = '$usuario', nivel = $nivel
        WHERE id = $id";
    }

    mysqli_query($conexao, $sql);
    header('Location: admin.php');
    exit;
}

// Seleciona os dados da tabela usuários
$sql = "SELECT * FROM usuarios WHERE id=$id";

// Executa o Select 
$resultado = mysqli_query($conexao, $sql);

// Gera um vetor com os dados retornados
$dados = mysqli_fetch_assoc($resultado);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>

    <h1> Editar Usuário </h1>

    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <br>
        Nome: <br>
        <input type="text" name="nome" value="<?php echo $dados['nome']; ?>"> <br>
        Usuário: <br>
        <input type="text" name="usuario" value="<?php echo $dados['usuario']; ?>"> <br>
        Nível de acesso:
        <select name="nivel">
            <?php
            if ($dados['nivel'] == 1) {
                echo '<option value="1" selected>Comum</option>';
                echo '<option value="2">Administrador</option>';
            } else {
                echo '<option value="1">Comum</option>';
                echo '<option value="2" selected>Administrador</option>';
            }
            ?>
        </select> <br>
        Resetar para senha padrão (teste123): 
        <select name="senha">
            <option value="n" selected>Não</option>
            <option value="s">Sim</option>
        </select> <br>

        <br>

        <input type="submit" value="Editar">
    </form>

    <hr>
    <a href="index.php"> Voltar </a>

</body>

</html>