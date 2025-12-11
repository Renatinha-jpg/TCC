<?php 
include_once "auth.php"; 
$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);
?>

<div class="navbar-fixed">
  <nav class="white">
    <div class="nav-wrapper container">

      <!-- LOGO -->
      <a href="index.php" class="brand-logo">
        <img src="img/pq.png" height="60" width="250" alt="Portal Químico">
      </a>

      <a href="#" data-target="mobile" class="sidenav-trigger black-text">
        <i class="material-icons">menu</i>
      </a>

      <ul class="right hide-on-med-and-down">
        <li><a class="black-text <?php echo $paginaCorrente == 'index.php' ? 'underline' : ''; ?>" href="index.php">Home</a></li>
        <li><a class="black-text <?php echo $paginaCorrente == 'materiais.php' ? 'underline' : ''; ?>" href="materiais.php">Materiais</a></li>
        <li><a class="black-text <?php echo $paginaCorrente == 'forum.php' ? 'underline' : ''; ?>" href="forum.php">Fórum</a></li>

        <?php if (isset($_SESSION['id_usuario'])): ?>
          <!-- JÁ ESTÁ LOGADO -->
          <li>
            <span style="background:#4fa1eb; padding:8px 16px; border-radius:30px; font-weight:600;">
              <i class="material-icons left tiny">person</i>
              <?php echo htmlspecialchars($_SESSION['usuario']); ?>
              <?php if ($_SESSION['tipo'] === 'admin'): ?>
                <span style="background:#c62828; color:white; padding:2px 8px; border-radius:12px; font-size:0.75rem; margin-left:6px;">ADMIN</span>
              <?php endif; ?>
            </span>
          </li>

          <?php if ($_SESSION['tipo'] === 'admin'): ?>
            <li><a class="black-text" href="materiaisadm.php">Gerenciar</a></li>
            <li><a class="black-text" href="usuariosadm.php">Usuários</a></li>
          <?php endif; ?>

          <li><a href="logout.php" class="red-text">
            <i class="material-icons left">logout</i> Sair
          </a></li>

        <?php else: ?>
          <!-- NÃO ESTÁ LOGADO -->
          <li><a class="black-text <?php echo $paginaCorrente == 'registrar.php' ? 'underline' : ''; ?>" href="registrar.php">Cadastro</a></li>
          <li><a class="black-text <?php echo $paginaCorrente == 'login.php' ? 'underline' : ''; ?>" href="login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</div>

<!-- MENU MOBILE -->
<ul class="sidenav" id="mobile">
  <li><a href="index.php">Home</a></li>
  <li><a href="materiais.php">Materiais</a></li>
  <li><a href="forum.php">Fórum</a></li>
  <?php if (isset($_SESSION['id_usuario'])): ?>
    <li class="divider"></li>
    <li><b>Olá, <?php echo $_SESSION['usuario']; ?></b></li>
    <?php if ($_SESSION['tipo'] === 'admin'): ?>
      <li><a href="materiaisadm.php">Gerenciar Materiais</a></li>
      <li><a href="gerenciar_usuarios.php">Usuários</a></li>
    <?php endif; ?>
    <li><a href="logout.php" class="red-text">Sair</a></li>
  <?php else: ?>
    <li><a href="registrar.php">Cadastro</a></li>
    <li><a href="login.php">Login</a></li>
  <?php endif; ?>
</ul>

<style>
  .underline { 
    text-decoration: underline !important; 
    text-decoration-color: #4fa1eb; 
    text-decoration-thickness: 3px; 
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    M.Sidenav.init(document.querySelectorAll('.sidenav'));
  });
</script>