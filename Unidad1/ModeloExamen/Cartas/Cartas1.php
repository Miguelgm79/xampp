<?php
session_start();

// a) Generar número binario aleatorio (4 bits)
$num_binario1 = rand(0, 1);
$num_binario2 = rand(0, 1);
$num_binario3 = rand(0, 1);
$num_binario4 = rand(0, 1);

// Vector con los bits
$binario = [$num_binario1, $num_binario2, $num_binario3, $num_binario4];

// b) Vector con potencias de 2
$potencias = [8, 4, 2, 1];

// c) Calcular número decimal asociado
$decimal = 0;
for ($i = 0; $i < 4; $i++) {
    $decimal += $binario[$i] * $potencias[$i];
}

// d) Guardar el número generado en sesión
$_SESSION['numero_decimal'] = $decimal;

// e) Mostrar cartas (cada una diferente según su potencia)
echo "<h2>Número binario generado: $num_binario1 $num_binario2 $num_binario3 $num_binario4</h2>";
echo "<div style='display:flex; gap:10px;'>";

// Array con imágenes diferentes para cada carta
$imagenes = [
    'corazon8.JPG',  // posición 0 → potencia 8
    'corazon4.JPG',  // posición 1 → potencia 4
    'corazon2.jpg',  // posición 2 → potencia 2
    'corazon1.JPG'   // posición 3 → potencia 1
];

for ($i = 0; $i < 4; $i++) {
    if ($binario[$i] == 1) {
        // carta encendida (mostramos la imagen correspondiente)
        echo "<img src='{$imagenes[$i]}' width='100' style='border:2px solid green;'>";
    } else {
        // carta apagada (mismo diseño pero en gris o reverso)
        echo "<img src='Negro.JPG' width='100' style='opacity:0.5;'>";
    }
}
echo "</div>";

echo "<br><h3>Introduce el número en decimal:</h3>";
echo "<form action='Cartas2.php' method='post'>
        <input type='number' name='numero_usuario' min='0' max='15' required>
        <input type='submit' value='Comprobar'>
      </form>";
?>
