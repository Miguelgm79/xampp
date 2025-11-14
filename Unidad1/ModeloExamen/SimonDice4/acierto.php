<?php
session_start();
require_once "pintarCirculos.php";


$conexion = new mysqli("localhost", "root", "", "bdsimon");
$codigoUsuario = $_SESSION["codigo"];
$acierto = 1; // porque estamos en ACUERTO

$sql = "INSERT INTO jugadas (codigousu, acierto) VALUES ($codigoUsuario, $acierto)";
$conexion->query($sql);
$conexion->close();

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

    <form action="login.php" method="post">
        <input type="submit" value="Jugar otra vez">
    </form>
    <br>
    <form action="estadisticas.php" method="post">
        <input type="submit" value="Estadisticas">
    </form>
</body>
</html>


