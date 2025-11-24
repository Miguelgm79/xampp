<?php
session_start();
require_once "pintar-emoji.php";

$usuario = $_SESSION["usuario"];

// Inicializa el número de emojis si no existe
if (!isset($_SESSION["num_emojis"])) {
    $_SESSION["num_emojis"] = 1;
}

// Si pulsa INCREMENTAR → suma 1 emoji
if (isset($_POST["incrementar"])) {
    if ($_SESSION["num_emojis"] < 5) {
        $_SESSION["num_emojis"]++;
    }
}

// Si llega a 5 → pasa directamente a la siguiente pantalla
if ($_SESSION["num_emojis"] == 5) {
    header("Location: agenda.php");   // ← cambia a tu siguiente archivo
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
</head>
<body>
    <h1>Agenda</h1>
    <p>Bienvenido <?php echo $usuario; ?>, cuantos contactos deseas grabar</p>
    <p>Puedes grabar entre 1 y 5 contactos de una sola vez pulsando en el boton de INCREMENTAR </p>
    <p>Cuando el numero sea el deseado pulse grabar</p>
    <?php pintar_emoji($_SESSION["num_emojis"]); ?>

    <form method="post">
        <button type="submit" name="incrementar">INCREMENTAR</button>
        <button type="submit" formaction="agenda.php">GRABAR</button>
    </form>
</body>
</html>