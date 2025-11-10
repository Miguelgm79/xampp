<?php
session_start();
require_once "pintarCirculos.php";


$correcta = $_SESSION["combinacion_correcta"];
$jugada = $_SESSION["jugada"];
unset($_SESSION["jugada"]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fallaste</title>
</head>
<body>
    <h2>Lo siento</h2>

    <h3>Combinación correcta:</h3>
    <?php pintar_circulos($correcta[0], $correcta[1], $correcta[2], $correcta[3]); ?>

    <h3>Tu jugada:</h3>
    <?php pintar_circulos($jugada[0], $jugada[1], $jugada[2], $jugada[3]); ?>

    <form action="inicio.php" method="post">
        <input type="submit" value="Intentar otra vez">
    </form>
    <br>
    <form action="estadisticas.php" method="post">
        <input type="submit" value="Estadisticas">
    </form>
</body>
</html>
