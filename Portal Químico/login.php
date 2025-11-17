<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Portal Químico - Login</title>
    
</head>

<body>

<?php 
    include_once "conecta.php";
?>
    <main class = "container">
              <div class="col s12 m8 offset-m2 l6 offset-l3">
            <form>

                <h1>Login</h1>

                <div class="input-box">
                    <input placeholder="Usuario" type="email">
                    <i class ="bx bxs-user"></i>
                </div>


                <div class="input-box">
                    <input placeholder="Senha" type="password">
                    <i class ="bx bxs-lock-alt"></i>
                </div>

                <div class="esqueceu-senha">
                <label>
                    <input type="checkbox" checked="checked" name="remember"/>
                    Lembre-se de mim
                </label>
                    <a href="recuperarsenha.php">Esqueceu a senha?</a>
                </div>


                <button type="submit" class="login">Entrar</button>

                <div class="register">
                    <p>Não tem uma conta? <a href="registrar.php">Registre-se!</a></p>
                </div>
            </div> 
            
           
                </form>
                <div class="voltar">
                <a href="index.php"> Voltar à pagina inicial</a>
                <div>
            </main> 
            
           

    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>