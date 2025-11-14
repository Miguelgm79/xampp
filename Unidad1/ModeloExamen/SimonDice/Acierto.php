<?php
session_start();
require_once "pintarCirculos.php";

$conexion = new mysqli("localhost", "root", "", "bdsimon");
$codigoUsuario = $_SESSION["codigo"];
$acierto = 1; // porque estamos en ACUERTO

$sql = "INSERT INTO jugadas (codigousu, acierto) VALUES ($codigoUsuario, $acierto)";
$conexion->query($sql);
$conexion->close();

$correcta = $_SESSION["combinacion_correcta"];
unset($_SESSION["jugada"]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>¡Acierto!</title>
</head>
<body>
    <h2>¡Has acertado </h2>
    <?php pintar_circulos($correcta[0], $correcta[1], $correcta[2], $correcta[3]); ?>

    <form action="inicio.php" method="post">
        <input type="submit" value="Nueva partida">
    </form>
    <br>
    <form action="estadisticas.php" method="post">
        <input type="submit" value="Estadisticas">
    </form>
</body>
</html>
