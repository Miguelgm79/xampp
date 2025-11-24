<?php

function pintar_contacto ($cantidad) {
      echo '<form method="post">';
    for ($i = 1; $i <= $cantidad; $i++) {
        echo <<<HTML
        <fieldset>
            <legend>CONTACTO {$i}</legend>

            <label for="nombre{$i}">Nombre:</label>
            <input type="text" id="nombre{$i}" name="nombre{$i}" required>

            <label for="telefono{$i}">Teléfono:</label>
            <input type="text" id="telefono{$i}" name="telefono{$i}" required>

            <label for="email{$i}">Email:</label>
            <input type="email" id="email{$i}" name="email{$i}" required>
        </fieldset>
        <br>
        HTML;
    }
    echo '</form>';
}

?>
