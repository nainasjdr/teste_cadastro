<?php
require_once('login.class.php'); 
//$objConnection = new Conexao();
$objLogin = new Login();
?>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<title> Cadastro de Usuário </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
                          }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
                      

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                          }//end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
</head>
<body>
<div class='form-cadastro'>
Cadastro: <br>
<form method="POST" action="">
<table>
<tr>
<td><label>Nome:</label></td>
<td><input type="text" name="nome" id="nome"></td>
</tr>
<tr>
<td><label>CPF:</label></td>
<td><input type="text" name="cpf" id="cpf"></td>
</tr>
<tr>
<td><label>Senha (8 digitos):</label></td>
<td><input type="password" name="senha" id="senha"></td>
</tr>
<tr>
<td>
<label>CEP:</label> </td>
<td><input type="text" name="cep" id="cep"> </td>
</tr>
<tr>
<td><label>Rua:</label></td>
<td><input type="text" name="rua" id="rua"></td>
</tr>
<tr>
<td><label>Bairro:</label></td>
<td><input type="text" name="bairro" id="bairro"></td>
</tr>
<tr>
<td><label>Cidade:</label></td>
<td><input type="text" name="cidade" id="cidade"></td>
</tr>
<tr>
<td><label>Estado:</label></td><td><input type="text" name="estado" id="estado"></td>
</tr>
<tr>
<td></td>
<td align="right"><input type="submit" value="Cadastrar" id="Cadastrar" name="Cadastrar"></td>
</tr>
</table>
</form>
</div>
<?php  
function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    return true; 
 } 
 
 if(isset($_POST["Cadastrar"]) && $_POST["Cadastrar"] == "Cadastrar"){  
  if(validaCPF($_POST["cpf"])) {  		
		$cadastrar = $objLogin->Cadastrar($_POST["cpf"],$_POST['nome'],$_POST['senha'],
		$_POST['rua'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['cep']);
	}else {
		 echo"<script language='javascript' type='text/javascript'>alert('CPF inválido');window.location.href='cadastro.php'</script>";
	}	
   }
?>
</body>
</html>

