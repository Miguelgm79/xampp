<?php
session_start();

// Conexión
$conexion = new mysqli("localhost", "root", "", "bdvalform");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Si no hay usuario logueado → error
if (!isset($_SESSION['usuario'])) {
    die("Acceso denegado. Debes iniciar sesión primero.");
}

$usuario = $_SESSION['usuario']; 

// Consulta al usuario
$stmt = $conexion->prepare("SELECT nombre, email, website, genero, comentarios FROM usuarios WHERE nombre=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
} else {
    die("No se encontraron datos del usuario.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas del Usuario</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Información del Usuario</h2>
    <table>
        <tr><th>Nombre</th><td><?php echo htmlspecialchars($fila['nombre']); ?></td></tr>
        <tr><th>Email</th><td><?php echo htmlspecialchars($fila['email']); ?></td></tr>
        <tr><th>Website</th><td><?php echo htmlspecialchars($fila['website']); ?></td></tr>
        <tr><th>Género</th><td><?php echo htmlspecialchars($fila['genero']); ?></td></tr>
        <tr><th>Comentarios</th><td><?php echo nl2br(htmlspecialchars($fila['comentarios'])); ?></td></tr>
    </table>
</body>
</html>
