<?php

echo <<<_END
    <html lang="es">
    <body>
        <h2>Formulario</h2>
        <form method="post" action="FormInicial3.php">
            
            <label for="jugador1">Jugador 1:</label>
            <input type="text" id="jugador1" name="jugador1" required><br><br>
            <label for="jugador2">Jugador 2:</label>
            <input type="text" id="jugador2" name="jugador2" required><br><br>
            <label for="jugador3">Jugador 3:</label>
            <input type="text" id="jugador3" name="jugador3" required><br><br>

            <button type="submit">Ver</button>
        </form>
    </body>
    </html>
    _END;

    session_start();
    $_SESSION['nombre'] = $_POST['nombre'];
    

?>