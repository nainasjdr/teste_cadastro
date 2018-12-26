<?php
require_once('login.class.php');
include_once('menu.php');
 $objLogin = new Login();
 ?>
<!DOCTYPE HTML>
<html lang="en-US">
   <head>
      <meta charset="iso-8859">
      <title>Dados Cadastrados</title> 
      <link rel="stylesheet" href="css/style.css" />
   </head>
   <body>
 
<h4>Dados Cadastrados</h4><br>
 <?php
$cpf= $objLogin->getIdUsuario();
$d_usuario=$objLogin->selecionarUsuarioLogado($cpf);
echo"CPF: ". $d_usuario["cpf"]."<br>";
echo"Nome: ". $d_usuario["nome"]."<br>";
echo"Rua/Av: ". $d_usuario["rua"]."<br>";
echo"Cidade: ". $d_usuario["cidade"]."<br>";
echo"Estado: ". $d_usuario["estado"]."<br>";
echo"CEP: ". $d_usuario["cep"]."<br>";
 ?>     

</body>
</html>