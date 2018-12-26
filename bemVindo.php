<?php
require_once('login.class.php');
include_once('menu.php');
 $objLogin = new Login();
 ?>
<!DOCTYPE HTML>
<html lang="pt-br">
   <head>   
      <title>Bem Vindo</title> 
      <link rel="stylesheet" type="text/css" href="style.css" />
   </head>
   <body>
<div>

 <?php
 echo "<h3>Bem Vindo(a) ".$objLogin->getNomeUsuario()." </h3> <br>";
 ?>     
 <br>       
  </div>    
      
    
   </body>
</html>