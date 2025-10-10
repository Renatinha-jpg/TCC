<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="registro.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Portal Químico - Registro</title>
</head>
<body>
    <?php include_once "header.php"; ?>
    <div>
        <main class = "container">
              <div class="col s12 m8 offset-m2 l6 offset-l3">
            <form>
                    
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
            <input placeholder="Senha" type="password">
            <i class ="bx bxs-lock-alt"></i>
        </div>


        <div class="input-box">
            <input placeholder="Confirmar Senha" type="password">
            <i class ="bx bxs-lock-alt"></i>
        </div>

        <button type="submit" class="register">Registrar</button>
        <p>Já tem uma conta? <a href="index.php">Login</a></p>
    </div>
            </form>
        </main>
    </div>

<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>