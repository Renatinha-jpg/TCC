<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css">
    <?php 
    include_once "header.php" ;
    include_once "conecta.php";
?>
    <title>Portal Químico - Home</title>
</head>

<body>
    <div class="container">
  <div class="section 1">
    <h2>Sobre o Projeto</h2>
    <div class="row">
      <div class="col s12"></div>
      <div class="col s8">
        
<p>
  Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto.
  Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto.
  Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto. Aqui haverá uma descrição sobre o projeto.
</p>
      </div>
      <div class="col s4">
        <img src="img/02.jpg" width="400" height="300">
      </div>
    </div>
  </div>

  <div class="section 1">
    <h2>Destaques</h2>
    <p> seção dedicada a materiais recem postados </p>
     <div class="row">
    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Destaque 1</span>
           <p class="white-text">Aqui haverá uma descrição sobre o destaque em questão.</p>
        </div>
    </div>
  </div>


    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Destaque 2</span>
          <p class="white-text">Aqui haverá uma descrição sobre o destaque em questão.</p>
        </div>
    </div>
  </div>

  <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Destaque 3</span>
          <p class="white-text">Aqui haverá uma descrição sobre o destaque em questão.</p>
        </div>
    </div>
  </div>
     </div>
</div>
    <script src="js/materialize.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {});
        });
    </script>
</body>

</html>


