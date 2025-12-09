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
        <li> <a class="black-text" <?php if($paginaCorrente == 'login.php'){echo 'style="text-decoration: underline;"';} ?> href="login.php">Login</a></li>    
        <li> <a class="black-text" <?php if($paginaCorrente == 'forum.php'){echo 'style="text-decoration: underline;"';} ?> href="forum.php">Fórum</a></li>
    </ul>

    <?php if (is_logged_in()): ?>
                <!-- Links para logado -->
                <a href="perfil.php">Perfil (<?php echo $_SESSION['usuario']; ?>)</a>
                <?php if (is_admin()): ?>
                    <!-- Links extras para admin -->
                    <a href="admin/gerenciar_usuarios.php">Gerenciar Usuários</a>
                    <a href="admin/gerenciar_materiais.php">Gerenciar Materiais</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>

    </div>
  </nav>
</div> 
