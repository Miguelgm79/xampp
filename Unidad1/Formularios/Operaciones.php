<?php
if (isset($_POST['num1']) && isset($_POST['num2'])) {

    echo <<<_END
    <html lang="es">>
    <body>
        <h2>Formulario</h2>
        <form method="post">
            <label for="num1">Número 1:</label>
            <input type="text" id="num1" name="num1" required><br><br>

            <label for="num2">Número 2:</label>
            <input type="text" id="num2" name="num2" required><br><br>

            <label for="ope">Operador</label>
            <input type="text" id="ope" name="ope" required><br><br>

            <button type="submit">Sumar</button>
        </form>
    </body>
    </html>
    _END;

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $ope = $_POST['ope'];

    switch {
        case '+': 
            $suma = $num1 + $num2;
            echo "la suma es de: $suma";
        break;
        case '-': 
            $resta = $num1 - $num2;
            echo "la resta es de: $resta";
        break;
        case '*': 
            $multi = $num1 * $num2;
            echo "la multi es de: $multi";
        break;
        case '/': 
            $div = $num1 / $num2;
            echo "la division es de: $div";
        break;
    }

} else {
    echo <<<_END
    <html lang="es">>
    <body>
        <h2>Formulario</h2>
        <form action="operaciones.php" method="post">
            <label for="num1">Número 1:</label>
            <input type="text" id="num1" name="num1" required><br><br>

            <label for="num2">Número 2:</label>
            <input type="text" id="num2" name="num2" required><br><br>

            <label for="ope">Operador</label>
            <input type="text" id="ope" name="ope" required><br><br>

            <button type="submit">Sumar</button>
        </form>
    </body>
    </html>
    _END;
}
?>
