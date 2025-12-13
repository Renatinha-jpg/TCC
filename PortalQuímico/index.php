<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Quimico</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include_once "header.php"; ?>

    <section class="hero center white-text">
        <div class="container">
            <h1 class="header">
                Portal Químico
            </h1>
            <p class="flow-text">
                <i>Essa página tem por objetivo compartilhar materiais didáticos de Química voltados para o ensino médio. <br>
                Os materiais foram elaborados de modo a permitir múltiplas formas de representação, ação e expressão, alinhando-se aos princípios do desenho universal para aprendizagem (DUA).<br>
                As propostas contemplam diversos conteúdos e buscam minimizar as barreiras no processo de aprendizagem de todos os alunos, ampliando a sua participação e aprendizagem.
                </i></p>
        </div>
    </section>

    <!-- Destaques -->
    <div class="container section">
        <h2 class="center section-title"><b>Destaques</b></h2>
        <div class="row">

            <!-- Card -->
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light center" style="background: #313372ff; padding: 40px;">
                        <i class="material-icons large" style="color: #f0feffff;">science</i>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><b><i>Resumo sobre o DUA</i></b></span>
                        <p><b>Um resumo sobre o DUA e sua importância...</b></p>
                        <a href="destaque1.php">Ver Mais</a>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light center" style="background: #313372ff; padding: 40px;">
                        <i class="material-icons large" style="color: #f0feffff;">science</i>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><b><i> Caixa de recursos com material concreto</i></b></span>
                        <p><b>A caixa de apoio com materiais concretos relacionados à Química inclui representações...</b></p>
                        <a href="destaque2.php">Ver Mais</a>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light center" style="background: #313372ff; padding: 40px;">
                        <i class="material-icons large" style="color: #f0feffff;">biotech</i>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><b><i>Sugestões de atividades que utilizem a caixa de recursos</i></b></span>
                        <p><b>Sugestões de atividades que podem ser realizadas com a caixa de recursos...</b></p>
                        <a href="destaque3.php">Ver Mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>