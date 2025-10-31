<?php
    session_start();

    if (isset($_POST['numero_usuario']) && isset($_SESSION['numero_decimal'])) {
        $usuario = (int)$_POST['numero_usuario'];
        $generado = $_SESSION['numero_decimal'];

        echo "<h2>Resultado del juego</h2>";
        echo "<p>Número introducido por el usuario: <b>$usuario</b></p>";
        echo "<p>Número correcto generado: <b>$generado</b></p>";

        if ($usuario === $generado) {
            echo "<h3 style='color:green;'>¡Has acertado!</h3>";
        } else {
            echo "<h3 style='color:red;'>Fallaste</h3>";
        }

        echo "<br><a href='Cartas1.php'>Volver a jugar</a>";
    } else {
        echo "<p>Error: No se encontró el número generado. Vuelve al <a href='Cartas1.php'>inicio</a>.</p>";
    } 

?>