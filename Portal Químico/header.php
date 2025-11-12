 <?php
  $pc = basename($_SERVER['SCRIPT_NAME']);
  //echo $pagina_corrente;
  ?>

 <div class="navbar-fixed">
   <nav class="light-blue darken-3">
     <div class="nav-wrapper container">
       <a href="#" class="brand-logo"></a>
       <ul id="nav-mobile" class="right hide-on-small-only">
         <li <?php if ($pc == 'index.php') {
                echo 'class="active"';
              } ?>><a href="index.php">Home</a></li>
         <li <?php if ($pc == 'materiais.php') {
                echo 'class="active"';
              } ?>><a href="materiais.php">Materiais</a></li>
         <li <?php if ($pc == 'exercicios.php') {
                echo 'class="active"';
              } ?>><a href="exercicios.php">Exercícios</a></li>
         <li <?php if ($pc == 'exercicios.php') {
                echo 'class="active"';
              } ?>><a href="login.php">Login</a></li>
         <li><a href="#login-modal" class="modal-trigger">Login</a></li>
       </ul>
     </div>
   </nav>
 </div>

 <div id="login-modal" class="modal">
   <div class="modal-content">
        <main class = "container">
              <div class="col s12 m8 offset-m2 l6 offset-l3">

            <form>

                <h1>Login</h1>

                <div class="input-box">
                    <input placeholder="Usuario" type="email">
                    <i class ="bx bxs-user"></i>
                </div>


                <div class="input-box">
                    <input placeholder="Senha" type="password">
                    <i class ="bx bxs-lock-alt"></i>
                </div>

                <div class="esqueceu-senha">
                <label>
                    <input type="checkbox" checked="checked" name="remember"/>
                    Lembre-se de mim
                </label>
                    <a href="senhaesqueceu.php">Esqueceu a senha?</a>
                </div>


                <button type="submit" class="login">Entrar</button>

                <div class="register">
                    <p>Não tem uma conta? <a href="registrar.php">Registre-se</a></p>
                </div>
            </div> 
            
           
                </form>
            </main> 

   </div>
   </form>
 </div>