 <?php
 $pc= basename($_SERVER['SCRIPT_NAME']);
 //echo $pagina_corrente;
 ?>

<div class="navbar-fixed">  
<nav class="blue darken-3">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-small-only">
        <li <?php if ($pc =='index.php') {echo'class="active"';}?>><a href="index.php">Home</a></li>
        <li <?php if ($pc =='Destinos.php') {echo'class="active"';}?>><a href="Destinos.php">Destinos</a></li>
        <li <?php if ($pc =='Quem.php') {echo'class="active"';}?>><a href="Quem.php">Quem somos</a></li>
        <li <?php if ($pc =='Login.php') {echo'class="active"';}?>><a href="Login.php">Login</a></li>
      </ul>
    </div>
  </nav>
  </div>
