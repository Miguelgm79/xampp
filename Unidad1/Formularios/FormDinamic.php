<?php
if(!isset($_POST['num1']) && isset($_POST['cj'])) { //2 carga de la pagina
 $cj1 = $_POST['cj'];
    echo <<< _END
  <form method="post">
  <input type="hidden" name="cj" value="$cj1">
  _END;
    for ($i = 1; $i <= $cj1; $i++) {
            echo <<< _END
                <label for="num$i">Número $i:</label>
                <input type="text" id="num$i" name="num$i" required><br><br>
            _END;
        }
    echo <<< _END
    <button type="submit">Mostrar</button>
    </form>
    _END;

}elseif (isset($_POST['num1'])) { // 3 carga
    $cj = $_POST['cj'];

    echo "<h2>Resultados</h2>";
    for ($j = 1; $j <= $cj; $j++) {
        $num = $_POST["num$j"];
        echo "El número $j es $num<br><br>";
    }

}else { //carga 1 
echo <<<_END
<html>
<body>
    <h2>Formulario</h2>
    <form method="post">
        <label for="cj">Número de cajas:</label>
                <input type="text" id="cj" name="cj" required><br><br>
        <button type="submit">Mostrar</button>
    </form>
</body>
</html>
_END;
}
?>
