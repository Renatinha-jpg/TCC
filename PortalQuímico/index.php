

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Quimico</title>
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
    <?php include_once "header.php"; ?>

    <!-- Hero -->
    <section class="hero center white-text">
        <div class="container">
            <h1 class="header" style="font-size: 4.5rem; font-weight: 700;">
                Química
            </h1>
            <p class="flow-text" style="font-size: 1.6rem;">
                Materiais gratuitos para o Ensino Médio
            </p>
        </div>
    </section>

    <!-- Destaques -->
    <div class="container section">
        <h2 class="center section-title"><b>Destaques</b></h2>
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light center" style="background: #313372ff; padding: 40px;">
                        <i class="material-icons large" style="color: #00c2cb;">atom</i>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><b><i>Titulo</i></b></span>
                        <p><b>Texto</b></p>
                    </div>
                </div>
                </div>
            </div>
    </div>
    
 <footer>
        <p> 2025 Química Acessível — TCC Ensino Médio + Técnico em Informática</p>

</footer>



    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.Sidenav.init(document.querySelectorAll('.sidenav'));
        });
    </script>
</body>
</html>