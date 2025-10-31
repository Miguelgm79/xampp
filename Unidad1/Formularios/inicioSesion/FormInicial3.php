<?php
session_start();

$nombre = $_SESSION['nombre'];
$jugador1 = $_POST['jugador1'];
$jugador2 = $_POST['jugador2'];
$jugador3 = $_POST['jugador3'];


echo "Buenos dias $nombre, los jugadores que has elegido son: $jugador1, $jugador2 y $jugador3"
?>