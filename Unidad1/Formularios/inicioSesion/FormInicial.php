<?php

 echo <<<_END
    <html lang="es">
    <body>
        <h2>Formulario</h2>
        <form method="post" action="FormInicial2.php">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>

            <button type="submit">jugar</button>
        </form>
    </body>
    </html>
    _END;

?>