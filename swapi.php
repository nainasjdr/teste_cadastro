<?php
include_once('menu.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Swapi</title>
</head>
<body>
Busque um planeta na plataforma swapi<br>
    <input class='input-id' type="text" name='id' placeholder="1-15">
    <button onclick="sendRequest()">Buscar Planeta</button>
    <p id='error-container' style='color:red;'></p>
    <p>
        Nome: <span id='name'></span>    
    </p>
    <p>
        Gravidade: <span id='gravity'></span>    
    </p>
    <p>
        População: <span id='population'></span>    
    </p>
    <p>
       Período de rotação: <span id='rotation-period'></span>    
    </p>
     <p>
      Clima: <span id='climate'></span>    
    </p>
    <p>
      Terreno: <span id='terrain'></span>    
    </p>
    <script>
function sendRequest(){
    var pessoa = document.querySelector('.input-id'); 
    
    var xhttp = new XMLHttpRequest();   
    xhttp.onreadystatechange = function() {       
        if (this.readyState == 4 && this.status == 200) {
           var response  = this.responseText;
           var resultado    = JSON.parse(response);
           document.getElementById("name").innerHTML            = resultado.name;
           document.getElementById("gravity").innerHTML         = parseInt(resultado.gravity);
           document.getElementById("population").innerHTML      = resultado.population;
           document.getElementById("rotation-period").innerHTML = resultado.rotation_period;
           document.getElementById("climate").innerHTML = resultado.climate;
           document.getElementById("terrain").innerHTML = resultado.terrain;
        }

        if (this.readyState == 4 && this.status !== 200){
            document.getElementById("error-container").innerHTML = 'Data not found!';    
        }
    };

    var url = 'https://swapi.co/api/planets/'+pessoa.value;
    xhttp.open("GET", url, true);
    // envio da request
    xhttp.send();
}
    </script>
</body>
</html>