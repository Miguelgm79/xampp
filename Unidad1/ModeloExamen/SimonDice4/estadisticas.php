<?php
session_start();

// ----------------------------------------
//   CONEXIÓN A LA BASE DE DATOS
// ----------------------------------------
$conexion = new mysqli("localhost", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


// ----------------------------------------
//   FILTROS RECIBIDOS POR GET
// ----------------------------------------
$filtroCirculos = isset($_GET["circulos"]) && $_GET["circulos"] !== "" ? (int)$_GET["circulos"] : null;
$filtroColores  = isset($_GET["colores"])  && $_GET["colores"]  !== "" ? (int)$_GET["colores"]  : null;


// ----------------------------------------
//   CONSULTA SQL CON FILTROS
// ----------------------------------------
$sql = "
   SELECT 
       u.Codigo,
       u.Nombre,
       j.numCirculos,
       j.numColores,
       SUM(j.acierto) AS aciertos,
       SUM(CASE WHEN j.acierto = 0 THEN 1 ELSE 0 END) AS fallos
   FROM usuarios u
   LEFT JOIN jugadas j ON u.Codigo = j.codigousu
   WHERE 1 = 1
";

// AÑADIR LOS FILTROS
if ($filtroCirculos !== null) {
    $sql .= " AND j.numCirculos = $filtroCirculos";
}
if ($filtroColores !== null) {
    $sql .= " AND j.numColores = $filtroColores";
}

$sql .= "
   GROUP BY u.Codigo, u.Nombre, j.numCirculos, j.numColores
   ORDER BY u.Codigo, j.numCirculos, j.numColores;
";

$resultado = $conexion->query($sql);


// ----------------------------------------
//   PROCESAR RESULTADOS
// ----------------------------------------
$datos = [];
$maxAciertos = 0;

while ($fila = $resultado->fetch_assoc()) {

    $aciertos = (int)$fila["aciertos"];
    $fallos   = (int)$fila["fallos"];

    $datos[] = [
        "cod"      => $fila["Codigo"],
        "nombre"   => $fila["Nombre"],
        "circulos" => $fila["numCirculos"],
        "colores"  => $fila["numColores"],
        "aciertos" => $aciertos,
        "fallos"   => $fallos
    ];

    if ($aciertos > $maxAciertos) {
        $maxAciertos = $aciertos;
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
        .contenedor { width: 90%; margin: auto; text-align: center; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }

        th, td { border: 1px solid black; padding: 10px; }

        th { background-color: #ddd; }

        .barra {
            height: 25px;
            background-color: #4CAF50;
            color: white;
            text-align: right;
            padding-right: 5px;
            border-radius: 4px;
            font-weight: bold;
        }

        form { margin: 20px 0; }
        select { padding: 6px; }
        input[type="submit"], input[type="button"] { padding: 7px 15px; }

    </style>
</head>

<body>

<div class="contenedor">

    <h2>Estadísticas de Usuarios</h2>

    <!-- FORMULARIO DE FILTROS -->
    <form method="GET">
        <label>Círculos:</label>
        <select name="circulos">
            <option value="">Todos</option>
            <?php for ($i = 4; $i <= 8; $i++): ?>
                <option value="<?= $i ?>" <?= ($filtroCirculos === $i) ? "selected" : "" ?>>
                    <?= $i ?> círculos
                </option>
            <?php endfor; ?>
        </select>

        <label style="margin-left: 20px;">Colores:</label>
        <select name="colores">
            <option value="">Todos</option>
            <?php for ($j = 4; $j <= 8; $j++): ?>
                <option value="<?= $j ?>" <?= ($filtroColores === $j) ? "selected" : "" ?>>
                    <?= $j ?> colores
                </option>
            <?php endfor; ?>
        </select>

        <input type="submit" value="Filtrar" style="margin-left: 20px;">
    </form>


    <!-- TABLA DE ESTADÍSTICAS -->
    <table>
        <tr>
            <th>Código</th>
            <th>Usuario</th>
            <th>Círculos</th>
            <th>Colores</th>
            <th>Aciertos</th>
            <th>Fallos</th>
            <th>Gráfica</th>
        </tr>

        <?php foreach ($datos as $d): 
            $porcentajeBarra = $maxAciertos > 0 ? ($d["aciertos"] / $maxAciertos) * 100 : 0;
        ?>
        <tr>
            <td><?= $d["cod"] ?></td>
            <td><?= $d["nombre"] ?></td>
            <td><?= $d["circulos"] ?></td>
            <td><?= $d["colores"] ?></td>
            <td><?= $d["aciertos"] ?></td>
            <td><?= $d["fallos"] ?></td>
            <td>
                <div class="barra" style="width: <?= $porcentajeBarra ?>%;">
                    <?= $d["aciertos"] ?>
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
