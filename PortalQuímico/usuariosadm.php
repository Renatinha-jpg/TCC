<!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body>
<?php 
    include_once "headeradm.php" ;
    include_once "conecta.php";
?>
<main class="container"> 
<h1> Usuarios </h1> 
<table>
        <thead>
          <tr>
              <th>ID</th>
              <th>Nome do Usuario</th>
              <th>E-mail</th>
              <th>Classe</th>
              <th>Operações</th>
          </tr>
        </thead>
        <tbody>
 <?php
 $sql = "SELECT id, nome, email, classe FROM usuario";
 $resultado = mysqli_query($conexao,$sql);
 while ($linha = mysqli_fetch_assoc($resultado)) 
{ 
 ?> 
   <tr>
    <td> <?php echo $linha['id']; ?> </td>
    <td> <?php echo $linha['nome']; ?> </td>
    <td> <?php echo $linha['email']; ?> </td>
    <td> <?php echo $linha['classe']; ?> </td>
    <td> <a href="#modal<?php echo $linha['id']; ?>" class="modal-trigger">Deletar</a> |
    <a href="altuser.php"> Alterar </a></td>
   </tr>   
    

  <div id="modal<?php echo $linha['id']; ?>" class="modal">
    <div class="modal-content">
      <h4>Atenção</h4>
      <p>Voce tem certeza de que quer apagar o registro de <?php echo $linha['nome'];?>?</p>
    </div>
    <div class="modal-footer">

      <form action="excluirusuario.php" method="post">
        <input type="hidden" name="id" value="<?php echo $linha['id'];?>">
        <button class="btn waves-effect waves-light red" type="submit" name="action">Sim</button>
    
        <button class="modal-close btn green" type="button" name="action">Nao</button>
      </form>
 
    </div>
  </div>
   
   <?php
}
?>

    </tbody>
    </table>
    
    <h4> Deseja registrar um novo usuario? </h4>
    <a href="registrarusuarioadm.php" name="reg"> Registrar<a>

</main>
<script type="text/javascript" src="js/materialize.min.js"></script>
  <script src="js/materialize.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
              opacity: 0.7, 
              inDuration: 1000,  
            });
        });
    </script>

</body>
</html>