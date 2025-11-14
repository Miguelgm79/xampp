<?php
// Conexión BD
$conexion = new mysqli("localhost", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL 
$sql = "
   SELECT u.Codigo, u.Nombre, COALESCE(SUM(j.acierto), 0) AS total_aciertos
   FROM usuarios u
   LEFT JOIN jugadas j ON u.Codigo = j.codigousu
   GROUP BY u.Codigo, u.Nombre
   ORDER BY u.Codigo;  
";

$resultado = $conexion->query($sql);
$datos = [];
$maxAciertos = 0;

while ($fila = $resultado->fetch_assoc()) {
    $total = (int) $fila["total_aciertos"];
    $datos[] = [
        "cod_usu"  => $fila["Codigo"],
        "nombre"   => $fila["Nombre"],
        "aciertos" => $total
    ];

    if ($total > $maxAciertos) {
        $maxAciertos = $total;
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadística Simon Dice</title>
    <style>
        .contenedor {
            width: 70%;
            margin: auto;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #ddd;
        }

        .barra {
            height: 25px;
            background-color: #4CAF50;
            text-align: right;
            color: white;
            padding-right: 10px;
            font-weight: bold;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Estadísticas de Usuarios</h2>

    <table>
        <tr>
            <th>Código Usuario</th>
            <th>Usuario</th>
            <th>Total Aciertos</th>
            <th>Gráfica</th>
        </tr>

        <?php foreach ($datos as $info): 
            $porcentaje = $maxAciertos > 0 ? ($info["aciertos"] / $maxAciertos) * 100 : 0;
        ?>
        <tr>
            <td><?= $info["cod_usu"] ?></td>
            <td><?= $info["nombre"] ?></td>
            <td><?= $info["aciertos"] ?></td>
            <td>
                <div class="barra" style="width: <?= $porcentaje ?>%;">
                    <?= $info["aciertos"] ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <form action="login.php">
        <input type="submit" value="Volver al inicio">
    </form>
</div>

</body>
</html>