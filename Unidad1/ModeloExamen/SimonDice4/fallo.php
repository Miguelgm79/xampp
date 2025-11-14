<?php
session_start();
require_once "pintarCirculos.php";

$conexion = new mysqli("localhost", "root", "", "bdsimon");
$codigoUsuario = $_SESSION["codigo"];

$sql = "INSERT INTO jugadas (codigousu, acierto) VALUES ($codigoUsuario, 0)";
$conexion->query($sql);
$conexion->close();


$num_colores = $_SESSION["num_colores"];
$num_circulos = $_SESSION["num_circulos"];
$correcta = $_SESSION["combinacion_correcta"];
$jugada = $_SESSION["jugada"];
unset($_SESSION["jugada"]);
?>

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Has fallado</title>
    </head>
    <body>
        <h2>¡Lo siento, jugador 1</h2>
        <p>No acertaste la combinación de <?php echo $num_circulos; ?> círculos.</p>

        <div class="bloque">
            <h3>Combinación correcta:</h3>
            <?php pintar_circulos(...$correcta); ?>
        </div>

        <div class="bloque">
            <h3>Tu jugada:</h3>
            <?php pintar_circulos(...$jugada); ?>
        </div>

        <form action="login.php" method="post">
            <input type="submit" value="Intentar otra vez">
        </form>
        <br>
        <form action="estadisticas.php" method="post">
            <input type="submit" value="Estadisticas">
        </form>
    </body>
</html>


