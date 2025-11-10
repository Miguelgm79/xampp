<?php

// Conexión BD
$conexion = new mysqli("localhost", "root", "", "bdsimon");


// Consulta SQL
$sql = "
   SELECT  u.Codigo,u.Nombre,SUM(j.acierto) AS total_aciertos
    FROM usuarios u
    LEFT JOIN jugadas j ON u.Codigo = j.codigousu
    GROUP BY u.Codigo, u.Nombre
    ORDER BY u.Codigo;  
";

$resultado = $conexion->query($sql);
$datos = [];

$maxAciertos = 0;

while ($fila = $resultado->fetch_assoc()) {

    $total = $fila["total_aciertos"] ?? 0;

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
            width: 60%;
            margin: auto;
            text-align: center;
        }

        table {
            width: 50%;
            margin: auto;
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

        .grafica {
            width: 80%;
            margin: auto;
            margin-top: 30px;
        }

        .barra {
            height: 25px;
            background-color: #4CAF50;
            margin: 8px 0;
            text-align: right;
            color: white;
            padding-right: 10px;
            font-weight: bold;
            border-radius: 4px;
        }

        .etiqueta {
            text-align: left;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="contenedor">
        <h2>Estadísticas de Usuarios</h2>

        <!-- TABLA -->
        <table>
            <tr>
                <th>Codigo Usuario</th>
                <th>Usuario</th>
                <th>Total Aciertos</th>
                <th>Grafica</th>
                
            </tr>
            <!-- es un foreach q recorre el array datos y lo pasa a info y ese mismo despues muestra lo que se le diga -->
            <?php foreach ($datos as $info): ?> 
                <tr>
                    <td><?= $info["cod_usu"] ?></td>
                    <td><?= $info["nombre"] ?></td>
                    <td><?= $info["aciertos"] ?></td>
                    

                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>