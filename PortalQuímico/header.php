<?php
 $paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
 //echo $pagina_corrente;
 ?>

<div class="navbar-fixed">    
    <nav class="white">
    <div class="nav-wrapper container">
      <a href="img/pq.png" class="brand-logo"><img src="img/pq.png" height="60" width="250"></a>
      <a href="img/pq.png" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li> <a class="black-text" <?php if($paginaCorrente == 'index.php'){echo 'style="text-decoration: underline;"';} ?> href="index.php">Home</a></li>    
        <li> <a class="black-text" <?php if($paginaCorrente == 'materiais.php'){echo 'style="text-decoration: underline;"';} ?> href="materiais.php">Materiais</a></li> 
        <li> <a class="black-text" <?php if($paginaCorrente == 'forum.php'){echo 'style="text-decoration: underline;"';} ?> href="forum.php">Fórum</a></li>
        <li> <a class="black-text" <?php if($paginaCorrente == 'registrar.php'){echo 'style="text-decoration: underline;"';} ?> href="registrar.php">Cadastro</a></li>
        <li> <a class="black-text" <?php if($paginaCorrente == 'login.php'){echo 'style="text-decoration: underline;"';} ?> href="login.php">Login</a></li>
    </ul>
    </div>
  </nav>
</div> 
