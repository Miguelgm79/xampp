<?php

session_start();

$levantar=-1;

if (!isset($_SESSION['tablero'])){
    $cartas= ["copas_02.jpg", "copas_02.jpg", "copas_03.jpg", "copas_03.jpg", "copas_05.jpg", "copas_05.jpg"]; //nombres de las imagenes de las cartas copas
    shuffle($cartas); 
    $_SESSION['tablero']= $cartas; 
    $_SESSION['intentos']=0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['levantar'])){
    $levantar=$_POST['levantar'];
    $_SESSION['intentos']++;
}



echo <<<END
<h1>Bienvenido {$_SESSION['login']}</h1>
<h3>Cartas levantadas<input type="text" name="levantar" value="{$_SESSION['intentos']}"></h3>
END;

echo "<form action='mostrarcartas.php' method='post'>";
for ($i=0; $i<6; $i++){
    echo "<button type='submit' name='levantar'value='$i'>Levantar carta". ($i+1) ."</button>";
}
echo "</form>";


echo <<<END
<form action="resultado.php" method="post">
<label for="resultado1">Resultado 1:</label>
<input type="number" name="resultado1"required>
<label for="resultado2">Resultado 2:</label>
<input type="number" name="resultado2"required>
<input type="submit" name="comprobar" value="Comprobar">
</form>
END;

for ($i=0; $i<6; $i++){
    if ($i==$levantar){
        $imagen= "./imagenes/". $_SESSION['tablero'][$i];
        echo "<img src='$imagen' alt='carta'>";
    }
    else{
        echo "<img src='./imagenes/boca_abajo.jpg' alt='carta negra' width='200' height='200' margin-right='10px'>";
    }
}


?>