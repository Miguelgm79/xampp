<?php
if(isset($_POST['num1'])){
    echo "<h2>Resultados</h2>";

    for ($j = 1; $j <= 10; $j++) { 
        $num = $_POST["num$j"];
        echo "El número $j es $num<br><br>";
    }

} else {
    echo <<<_END
<html>
<body>
    <h2>Formulario</h2>
    <form method="post">
_END;

    for ($i = 1; $i <= 10; $i++) {
        echo <<< _END
            <label for="num$i">Número $i:</label>
            <input type="text" id="num$i" name="num$i" required><br><br>
_END;
    }

    echo <<<_END
        <button type="submit">Mostrar</button>
    </form>
</body>
</html>
_END;
}
?>
