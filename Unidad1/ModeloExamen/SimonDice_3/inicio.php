<?php
session_start();
require_once "pintarCirculos.php";


$colores_posibles = ["red", "blue", "yellow", "green", "pink", "orange", "purple", "brown"];
$num_circulos = $_SESSION["num_circulos"];
$num_colores = $_SESSION["num_colores"];

// Generar combinación
$combinacion = [];
for ($i = 0; $i < $num_circulos; $i++) {
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
    <h2>Jugador 1:</h2>
    <p>Dificultad: <?php echo $num_circulos; ?> círculos</p>
    <p>Dificultad: <?php echo $num_colores; ?> colores</p>
    <?php pintar_circulos(...$combinacion); ?>

    <form action="Jugar.php" method="post">
        <input type="submit" value="¡Jugar!">
    </form>
</body>
</html>
