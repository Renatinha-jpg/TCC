<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="materiais.css">
    <?php include_once "header.php"; ?>
    <title>Portal Químico - Materiais</title>
</head>

<body>
    <main class="container">
    <h4 class="center-align">Exercícios Disponíveis</h4>


    <div class="search-box">
      <p>Procurando algo específico?</p>
      <div class="input-field" style="max-width: 400px; margin: 0 auto;">
        <input id="search" type="search" required>
        <label class="label-icon" for="search"><i class="material-icons">Procurar</i></label>
      </div>
    </div>

   
       
    <div class="row">
    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">Exercícios sobre X</span>
          <p>Aqui haverá uma descrição sobre o grupo de exercícios separados por temática.</p>
        </div>
    </div>
  </div>


    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">Exercícios sobre X</span>
          <p>Aqui haverá uma descrição sobre o grupo de exercícios separados por temática.</p>
        </div>
    </div>
  </div>


    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">Exercícios sobre X</span>
          <p>Aqui haverá uma descrição sobre o grupo de exercícios separados por temática.</p>
        </div>
      </div>
    </div>
 </div>


    <div class="row">
    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">Exercícios sobre X</span>
          <p>Aqui haverá uma descrição sobre o grupo de exercícios separados por temática.</p>
        </div>
    </div>
  </div>

  <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">Exercícios sobre X</span>
          <p>Aqui haverá uma descrição sobre o grupo de exercícios separados por temática.</p>
        </div>
    </div>
  </div>
    
 <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-darken-4">Exercícios sobre X</span>
          <p>Aqui haverá uma descrição sobre o grupo de exercícios separados por temática.</p>
        </div>
    </div>
  </div>
    </div>
  </main>


  <footer>
<p>2025</p>
  </footer>


   <script src="js/materialize.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {});
        });
    </script>
</body>
</html>