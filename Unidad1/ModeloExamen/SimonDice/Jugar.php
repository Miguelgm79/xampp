<?php
session_start();
require_once "pintarCirculos.php";


if (!isset($_SESSION["jugada"])) $_SESSION["jugada"] = [];

if (isset($_POST["color"])) {
    $_SESSION["jugada"][] = $_POST["color"];
}

$jugada = $_SESSION["jugada"];
$circulos = array_pad($jugada, 4, "black");

if (count($jugada) == 4) {
    $correcta = $_SESSION["combinacion_correcta"];
    if ($jugada == $correcta) {
        $_SESSION["aciertos"]++;
        header("Location: Acierto.php");
        exit;
    } else {
        $_SESSION["fallos"]++;
        header("Location: Fallo.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Jugar - Simón Dice</title>
</head>
<body>
    <h2>Jugador 1:</h2> 
    <?php pintar_circulos($circulos[0], $circulos[1], $circulos[2], $circulos[3]); ?>

    <form method="post">
        <button name="color" value="red">ROJO</button>
        <button name="color" value="blue">AZUL</button>
        <button name="color" value="yellow">AMARILLO</button>
        <button name="color" value="green">VERDE</button>
    </form>
</body>
</html>
