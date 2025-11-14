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
  <?php 
    include_once "header.php" ;
    include_once "conecta.php";
?>
    <main class="container">
    <h4 class="center-align">Materiais Disponíveis</h4>


    <div class="nav-search">
              <div class="form-group">
                <input type="text" placeholder="Procurar" />
                <i class="fa-solid fa-magnifying-glass"></i>
              </div>

   
    <div class="row">
    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Materiais sobre X</span>
          <p class="white-text">Aqui haverá uma descrição sobre o grupo de materiais separados por temática.</p>
        </div>
    </div>
  </div>


    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Materiais sobre X</span>
           <p class="white-text">Aqui haverá uma descrição sobre o grupo de materiais separados por temática.</p>
        </div>
    </div>
  </div>


    <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Materiais sobre X</span>
           <p class="white-text">Aqui haverá uma descrição sobre o grupo de materiais separados por temática.</p>
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
          <span class="card-title activator white-text">Materiais sobre X</span>
           <p class="white-text">Aqui haverá uma descrição sobre o grupo de materiais separados por temática.</p>
        </div>
    </div>
  </div>

  <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
           <span class="card-title activator white-text">Materiais sobre X</span>
          <p class="white-text">Aqui haverá uma descrição sobre o grupo de materiais separados por temática.</p>
        </div>
    </div>
  </div>
    
 <div class="col s4 m4">
      <div class="card">
        <div class="card-image">
          <img src="img/02.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator white-text">Materiais sobre X</span>
           <p class="white-text">Aqui haverá uma descrição sobre o grupo de materiais separados por temática.</p>
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