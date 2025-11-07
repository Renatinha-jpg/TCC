<?php
  $pc = basename($_SERVER['SCRIPT_NAME']);
  //echo $pagina_corrente;
  ?>

 <div class="navbar-fixed">
   <nav class="light-blue darken-3">
     <div class="nav-wrapper container">
       <a href="#" class="brand-logo"></a>
       <ul id="nav-mobile" class="right hide-on-small-only">
        <li <?php if ($pc == 'materiaisadm.php') {
                echo 'class="active"';
              } ?>>
              <a href="homeadm.php">Editar Página Principal</a></li>

         <li <?php if ($pc == 'materiaisadm.php') {
                echo 'class="active"';
              } ?>>
              <a href="materiaisadm.php">Editar Materiais</a></li>

         <li <?php if ($pc == 'exercicios.php') {
                echo 'class="active"';
              } ?>>
              <a href="exerciciosadm.php">Editar Exercícios</a></li>
         <li <?php if ($pc == 'exerciciosadm.php') {
                echo 'class="active"';
              } ?>>

       </ul>
     </div>
   </nav>
 </div>