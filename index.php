<?php
require_once('login.class.php'); 
//$objConnection = new Conexao();
$objLogin = new Login();
?>
<html>
<head>
<title> Login de Usuário </title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class='form-login'>
Acessar: <br>
<form method="POST" action="">
<label>CPF:</label><input type="text" name="cpf" id="cpf" placeholder='012345678912'><br>
<label>Senha:</label><input type="password" name="senha" id="senha"><br>
<input type="submit" value="entrar" id="entrar" name="entrar"><br>
</form>
</div>
<br>
<br>
<?php 
	if(isset($_POST["entrar"]) && $_POST["entrar"] == "entrar"){ 
		$logar = $objLogin->Logar($_POST["cpf"],$_POST['senha']);
   }
?>
          
 <?php if (isset($logar)){ ?>
 
	<div class="mensagem-erro">
           <?php echo $logar ?>
            </div><?php }
 ?>
</body>
</html>
