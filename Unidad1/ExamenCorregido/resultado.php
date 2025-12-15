<?php

session_start();

$hn = 'localhost';
$db = 'cartas';
$un = 'root';
$pw = '';

$connection = new mysqli($hn, $un, $pw, $db);
 if ($connection->connect_error) die("Fatal Error");


echo "<h1>Bienvenido {$_SESSION['login']}</h1>";

$resultado1=$_POST['resultado1']-1; //como es array le restamos 1
$resultado2=$_POST['resultado2']-1;

$carta1 = $_SESSION['tablero'][$resultado1];
$carta2 = $_SESSION['tablero'][$resultado2];

if ($carta1==$carta2){
    echo "<h3>Acierto posiciones ". $_POST['resultado1']." y ".$_POST['resultado2']."</h3>";
    echo "<p>Se le sumara 1 punto asi como " . $_SESSION['intentos']." intentos</p>";
    $updatePuntos=1;
} else {
    echo "<h3>Fallo posiciones ". $_POST['resultado1']." y ".$_POST['resultado2']."</h3>";
    echo "<p>Se le restara 1 punto asi como " . $_SESSION['intentos']." intentos</p>";
    $updatePuntos=-1;
}

$intentos=$_SESSION['intentos'];
$login=$_SESSION['login'];

$stmt = $connection->prepare("UPDATE jugador SET puntos=puntos +?, extra=extra + ? WHERE jugador.login=?");
$stmt->bind_param("iis", $updatePuntos, $intentos, $login);
$stmt->execute();

$stmt->close();

$query="SELECT nombre, puntos, extra FROM jugador";
$resultado=$connection->query($query);

echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Puntos</th><th>Extra</th></tr>";
while ($fila=$resultado->fetch_assoc()){
    echo "<tr><td>".$fila['nombre']."</td><td>".$fila['puntos']."</td><td>".$fila['extra']."</td></tr>";
}
echo "</table>";
?>