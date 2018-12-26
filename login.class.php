<?php

session_start();
Class Login{
	private $conectar;

 function __construct(){
    if(!($this->conectar = mysqli_connect("localhost","root",""))){
          echo"<script language='javascript' type='text/javascript'>alert('Erro de conexão, tente mais tarde ')</script>";
      }else{
         if(!($con = mysqli_select_db($this->conectar,"Teste_emiolo"))){
           echo"<script language='javascript' type='text/javascript'>alert('Erro de conexão, tente mais tarde')</script>";          
         }
        
      }
   }
   
   function verificarLogado(){
      if(!isset($_SESSION["logado"])){
         header("Location:index.php");
         exit();
      }
   }
 
   function Logar($cpf,$senha){   
   $cpf=preg_replace("/[^0-9]/", "", $cpf);
     $q_usuario= mysqli_query($this->conectar,"select * from usuario where cpf ='".$cpf."'");
 
      if(mysqli_num_rows($q_usuario) == 1){
         $d_usuario = mysqli_fetch_array($q_usuario);
         if($d_usuario["senha"] ==md5($senha)){
            $_SESSION["cpf"] = $d_usuario["cpf"];
            $_SESSION["nome"]=$d_usuario["nome"];
            $_SESSION["logado"] = "sim";
           header("Location:bemVindo.php");
         }else{
            $Erro = "Senha e/ou CPF errado(s)!";
            return $Erro;
         }
      }else{
      	
        /*$Erro = "Senha e/ou CPF errado(s)!";        
         return $Erro;*/
           echo"<script language='javascript' type='text/javascript'>alert('Usuário não cadastrado!');window.location.href='cadastro.php'</script>";
        
      };
   }

 function Cadastrar($cpf,$nome,$senha,$rua,$bairro,$cidade,$estado,$cep){
 	if(strlen($senha)==8) {
 		$senha=md5($senha);
 		$cpf=preg_replace("/[^0-9]/", "", $cpf);
 		$cep=preg_replace("/[^0-9]/", "", $cep);
 		 $q_usuario= mysqli_query($this->conectar,"select * from usuario where cpf ='".$cpf."'");          
    
	if(mysqli_num_rows($q_usuario) == 1) {
		echo"<script language='javascript' type='text/javascript'>alert('Usuário já cadastrado!');window.location.href='index.php'</script>";
		}else{	 
 			$query = "INSERT INTO usuario (cpf,nome,senha,rua,bairro,cidade,estado,cep) VALUES ('$cpf','$nome','$senha','$rua','$bairro','$cidade','$estado','$cep')";
        	$insert = mysqli_query($this->conectar,$query);         
        	if($insert){
          	echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='index.php'</script>";
          
        	}else{
         	 echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='cadastro.php'</script>";
        	}
  		}   
  }else {
  	echo"<script language='javascript' type='text/javascript'>alert('A senha deve ter 8 digitos');window.location.href='cadastro.php'</script>";
  }  
 }
   function getIdUsuario(){
      return $_SESSION["cpf"];
   }
   function getNomeUsuario(){
      return $_SESSION["nome"];
   }
 
 
   function deslogar(){
      session_destroy();
      header("Location:index.php");
   }
   
    function selecionarUsuarioLogado($cpf){   
     $q_usuario= mysqli_query($this->conectar,"select * from usuario where cpf ='".$cpf."'");
 
      if(mysqli_num_rows($q_usuario) == 1){
         $d_usuario = mysqli_fetch_array($q_usuario);
         return $d_usuario;           
         }else{
             $Erro= "Usuário Não existe!";
            return $Erro;
         }
      
   }

  function selecionarParticipantes(){   
     $q_usuario= mysqli_query($this->conectar,"select nome from usuario ");      
      $d_usuario =
     "<table border>
			  <tr>
			  <td>PARTICIPANTES</td>		   	
			  </tr>";		
	while($linha = mysqli_fetch_array($q_usuario)){
   	$d_usuario .="<tr>
			  <td>".$linha["nome"]."</td>		   	
			  </tr>";
	}
 	$d_usuario .="</table>";
  	return $d_usuario;
             
   } 
  
 
}
?>