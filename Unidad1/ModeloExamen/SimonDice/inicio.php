<?php
session_start();
require_once "pintarCirculos.php";

$colores_posibles = ["red", "blue", "yellow", "green"];
$combinacion = [];

for ($i = 0; $i < 4; $i++) {
    $combinacion[] = $colores_posibles[array_rand($colores_posibles)];
}

$_SESSION["combinacion_correcta"] = $combinacion;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio - Simón Dice</title>
</head>
<body>
    <h2>Bienvenido jugador 1</h2>
    <h3>Combinación generada (oculta al jugador)</h3>

    <?php pintar_circulos($combinacion[0], $combinacion[1], $combinacion[2], $combinacion[3]); ?>

    <form action="jugar.php" method="post">
        <input type="submit" value="¡Jugar!">
    </form>
</body>
</html>
