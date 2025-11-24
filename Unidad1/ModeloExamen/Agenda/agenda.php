<?php
session_start();
require_once "pintar-contacto.php";

$usuario = $_SESSION["usuario"];
$num_emoji = $_SESSION["num_emojis"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRABAR CONTACTOS</title>
</head>
<body>
    <h1>Hola <?php echo $usuario; ?></h1>
    <?php pintar_contacto($_SESSION["num_emojis"]); ?>

    <form method="post" action="grabado.php">
        <button type="submit">GRABAR</button>
    </form>
</body>
</html>