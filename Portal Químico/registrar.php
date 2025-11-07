<?php
if($_GET){
    $mensagem = $_GET["mensagem"];
}
else {
    $mensagem = '';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="registro.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<?php 
    include_once "conecta.php";
?>
    <title>Portal Químico - Registro</title>
</head>
<body>

    <div>
        <main class = "container">
              <div class="col s12 m8 offset-m2 l6 offset-l3">
            <form method="post" action="registrado.php">
                    
                <h1>Registrar</h1>

        <div class="input-box">
            <input placeholder="Usuario" type="text">
            <i class ="bx bxs-user"></i>
        </div>

        <div class="input-box">
            <input placeholder="Email" type="email">
            <i class ="bx bxs-envelope"></i>
        </div>

        <div class="input-box">
            <input placeholder="Senha" type="password" id="senha">
            <i class ="bx bxs-lock-alt"></i>
        </div>


        <div class="input-box">
            <input placeholder="Confirmar Senha" type="password" id="confirmar">
            <i class ="bx bxs-lock-alt"></i>
        </div>
        <div id="mensagem">
            <?php echo $mensagem; ?>
        </div>

        <button type="submit" class="register" id="register" disabled>Registrar</button>
        <p>Já tem uma conta? <a href="index.php">Voltar à pagina inicial</a></p>
    </form>
</div>
        </main>
    </div>

<script type="text/javascript" src="js/materialize.min.js">
</script>
<script>
    const senha = document.getElementById("senha");
    const confirmarSenha = document.getElementById("confirmar");
    const botao = document.getElementById("register");
    const mensagem = document.getElementById("mensagem");

    function verificarSenhas(){
        if(senha.value === "" || confirmarSenha.value === ""){
            botao.disabled = true;
            mensagem.textContent = "";
            return;
        }
        if(senha.value != confirmarSenha.value){
            botao.disabled = true;
            mensagem.textContent = "Senhas diferentes";
            mensagem.style.color = "red";
        } else {
            botao.disabled = false;
            console.log("Senhas iguais");
            mensagem.textContent = "";
        }
    }

    senha.addEventListener("input", verificarSenhas);
    confirmarSenha.addEventListener("input", verificarSenhas);
</script>
</body>
</html>