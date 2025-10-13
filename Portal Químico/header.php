 <?php
 $pc= basename($_SERVER['SCRIPT_NAME']);
 //echo $pagina_corrente;
 ?>

<div class="navbar-fixed">  
  <nav class="light-blue darken-3">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo"></a>
      <ul id="nav-mobile" class="right hide-on-small-only">
        <li <?php if ($pc =='index.php') {echo'class="active"';}?>><a href="index.php">Home</a></li>
        <li <?php if ($pc =='materiais.php') {echo'class="active"';}?>><a href="materiais.php">Materiais</a></li>
        <li <?php if ($pc =='exercicios.php') {echo'class="active"';}?>><a href="exercicios.php">Exercícios</a></li>
        <li <?php if ($pc =='login.php') {echo'class="active"';}?>><a href="login.php">Login</a></li>
      </ul>
    </div>
  </nav>
</div>
