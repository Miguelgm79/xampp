<?php
session_start();
require_once "pintarCirculos.php";


$correcta = $_SESSION["combinacion_correcta"];
$jugada = $_SESSION["jugada"];
$num_circulos = $_SESSION["num_circulos"];

// Limpiamos jugada para la siguiente partida
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

    <form action="Dificultad.php" method="post">
        <input type="submit" value="Intentar otra vez">
    </form>
</body>
</html>
