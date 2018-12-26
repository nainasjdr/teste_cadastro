<?php
include_once('menu.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Swapi-Pessoas</title>
</head>
<body>
Pesquise as características de personagens do starWars <br>
    <input class='input-id' type="text" name='id' placeholder="1-88">
    <button onclick="SelecionarPessoaSwapi()">Enviar</button>
    <p id='error-container' style='color:red;'></p>
    <p>
        Nome: <span id='name'></span>    
    </p>
    <p>
        Gênero: <span id='gender'></span>    
    </p>
    <p>
        Tamanho: <span id='height'></span>    
    </p>
    <p>
        Peso: <span id='mass'></span>    
    </p>
     <p>
        Cor do cabelo: <span id='hair_color'></span>    
    </p>
      <p>
        Cor da pele: <span id='skin_color'></span>    
    </p>
    <script>
function SelecionarPessoaSwapi(){
    var pessoa = document.querySelector('.input-id');  
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           var response  = this.responseText;
           var resultado    = JSON.parse(response);
           document.getElementById("name").innerHTML            = resultado.name;
           document.getElementById("mass").innerHTML         = parseInt(resultado.mass);
           document.getElementById("height").innerHTML      =parseInt (resultado.height);
           document.getElementById("gender").innerHTML = resultado.gender;
           document.getElementById("hair_color").innerHTML = resultado.hair_color;
           document.getElementById("skin_color").innerHTML = resultado.skin_color;        }
 
       
        if (this.readyState == 4 && this.status !== 200){
            document.getElementById("error-container").innerHTML = 'Data not found!';    
        }
    };
    // URL da API
    var url = 'https://swapi.co/api/people/'+pessoa.value;   
    xhttp.open("GET", url, true);
     xhttp.send();
}
    </script>
</body>
</html>