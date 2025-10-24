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
    include_once "header.php" ;
    include_once "conect.php";
?>
<main class="container"> 
<h1> Usuarios </h1> 
<table>
        <thead>
          <tr>
              <th>ID</th>
              <th>Nome do Usuario</th>
              <th>E-mail</th>
              <th>Operacao</th>
          </tr>
        </thead>
        <tbody>
 <?php
 $sql = "SELECT id,nome,email FROM usuarios";
 $resultado = mysqli_query($conexao,$sql);
 while ($linha = mysqli_fetch_assoc($resultado)) 
{ 
 ?> 
   <tr>
    <td> <?php echo $linha['id']; ?> </td>
    <td> <?php echo $linha['nomeUsuario']; ?> </td>
    <td> <?php echo $linha['email']; ?> </td>
    <td> <a href="#modal" class="modal-trigger">Deletar</a></td>
   </tr>   
  
   <?php
}
?>

    </tbody>
    </table>
      
</main>
<script type="text/javascript" src="js/materialize.min.js"></script>
  <script src="js/materialize.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {});
        });
    </script>

</body>
</html>