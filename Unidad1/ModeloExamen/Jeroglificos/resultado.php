<?php
session_start();
$conexion = new mysqli("localhost", "Jugador", "", "jeroglifico");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos.");
}

$sql = "SELECT COUNT(login) as total FROM respuestas r, solucion where respuesta = solucion AND r.fecha = CURDATE();";
$sql2 = "SELECT login, hora FROM respuestas r, solucion s WHERE r.respuesta = s.solucion AND r.fecha = CURDATE();";

$resCount = $conexion->query($sql);
$filaCount = $resCount->fetch_assoc();
$numJ = $filaCount["total"];

$resultado = $conexion->query($sql2);
$datos = [];

while ($fila = $resultado->fetch_assoc()) {
    $datos[] = [
        "login"  => $fila["login"],
        "hora"   => $fila["hora"],
    ];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
</head>
<body>
    <h1>Fecha: <?php echo date("d/m/Y"); ?></h1>    
    <h1>Jugadores acertados: <?php $numJ ?> </h1>
    <table  border="1" cellpadding="6">
        <tr>
            <th>Login</th>
            <th>Fecha</th>
        </tr>
         <?php foreach ($datos as $fila): ?>
        <tr>
            <td><?= ($fila["login"]) ?></td>
            <td><?= ($fila["hora"]) ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
</body>
</html>