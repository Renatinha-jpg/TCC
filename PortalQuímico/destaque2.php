<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Químico - Caixa de Recursos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="destaques.css">
    <style>
        .resource-card {
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important;
        }
        .card-title i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php include_once "header.php"; ?>

    <section class="hero center white-text">
        <div class="container">
            <h1 class="header">
                <b>Caixa de recursos com material concreto</b>
            </h1>
        </div>
    </section>

    <div class="container section">
        <div class="row">
            <p class="flow-text center-align grey-text text-darken-3">
                A caixa de apoio com materiais concretos relacionados à Química inclui representações bidimensionais da estrutura atômica, prótons, nêutrons, elétrons, ligações, setas reacionais e elementos químicos, bem como representações tridimensionais de alguns tipos de geometrias moleculares.
                <br><br>
                A proposta é que essa caixa de apoio possa ser utilizada ao longo das aulas de Química com o intuito de facilitar o processo de aprendizagem de diversos conteúdos, especialmente daqueles que requerem maior grau de abstração.
                <br><br>
                Abaixo você encontrará links que dão acesso a materiais que permitem a construção de uma caixa similar.
            </p>
             <img src="img/caixa.png" alt="Imagem" style="width:900px;height:500px;align-content:center;">
        </div>

        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card resource-card blue lighten-5">
                    <div class="card-content center">
                        <i class="material-icons blue-text text-darken-1">description</i>
                        <span class="card-title blue-text text-darken-1">Modelos Bidimensionais</span>
                        <p class="grey-text text-darken-3">
                            Acesso ao arquivo para impressão dos modelos 2D (estrutura atômica, ligações, elementos químicos, etc.)
                        </p>
                        <a href="https://drive.google.com/file/d/1i7xbspi-YAfEkdtj8oWk3qACGoKTK2u2/view?usp=sharing" 
                           target="_blank" class="btn waves-effect waves-light blue darken-1">
                            <i class="material-icons left">download</i> Baixar / Visualizar
                        </a>
                    </div>
                </div>
                <div class="card resource-card blue lighten-5">
                    <div class="card-content center">
                        <i class="material-icons blue-text text-darken-1">language</i>
                        <span class="card-title blue-text text-darken-1">Modelos Moleculares 3D</span>
                        <p class="grey-text text-darken-3">
                            Acesso à pasta com arquivos para impressão de modelos tridimensionais de geometrias moleculares
                        </p>
                        <a href="https://drive.google.com/drive/folders/170kaUFdS6SWIzpRit_z5DgIdyebmui29?usp=sharing" 
                           target="_blank" class="btn waves-effect waves-light blue darken-1">
                            <i class="material-icons left">folder_open</i> Abrir Pasta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>