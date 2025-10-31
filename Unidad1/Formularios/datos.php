<?php
if (isset($_POST['num1']) && isset($_POST['num2'])) {

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $suma = $num1 + $num2;

    echo "<h2>La suma de $num1 + $num2 es: $suma</h2>";

} else {
    echo <<<_END
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sumador</title>
    </head>
    <body>
        <h2>Formulario de Suma</h2>
        <form action="datos.php" method="post">
            <label for="num1">Número 1:</label>
            <input type="number" id="num1" name="num1" required><br><br>

            <label for="num2">Número 2:</label>
            <input type="number" id="num2" name="num2" required><br><br>

            <button type="submit">Sumar</button>
        </form>
    </body>
    </html>
    _END;
}
?>
