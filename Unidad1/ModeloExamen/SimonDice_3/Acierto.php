<?php
session_start();
require_once "pintarCirculos.php";


$num_colores = $_SESSION["num_colores"]; 
$correcta = $_SESSION["combinacion_correcta"];
$num_circulos = $_SESSION["num_circulos"];

// Limpiamos la jugada para la próxima partida
unset($_SESSION["jugada"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Has acertado!</title>
</head>
<body>
    <h2>¡Enhorabuena, jugador 1</h2>
    <p>Has acertado la combinación de <?php echo $num_circulos; ?> círculos.</p>

    <?php pintar_circulos(...$correcta); ?>

    <form action="Dificultad.php" method="post">
        <input type="submit" value="Jugar otra vez">
    </form>
</body>
</html>
