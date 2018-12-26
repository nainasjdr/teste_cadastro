<?php
require_once('login.class.php');
include_once('menu.php');
 $objLogin = new Login();
 ?>
<!DOCTYPE HTML>
<html lang="pt-br">
   <head>
      <meta charset="iso-8859">
      <title>Lista de participantes</title> 
      <link rel="stylesheet" href="css/style.css" />
   </head>
   <body>
 
<h4>Participantes</h4><br>
 <?php
$d_usuario=$objLogin->selecionarParticipantes();
echo $d_usuario;
 ?> 

</body>
</html>