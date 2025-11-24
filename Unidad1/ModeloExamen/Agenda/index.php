<?php
session_start();

//Crea un objeto de conexión a MySQL usando la extensión mysqli
$conexion = new mysqli("localhost", "root", "", "agenda");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    // CONSULTA SELECT
    $sql = "SELECT * FROM usuarios WHERE Nombre = '$usuario' AND Clave = '$clave'";
    
    $resultado = $conexion->query($sql);

    
    if ($resultado->num_rows == 1) {

        $datos = $resultado->fetch_assoc();

        $_SESSION["usuario"] = $datos["Nombre"];
        $_SESSION["rol"] = $datos["Rol"];
        $_SESSION["codigo"] = $datos["Codigo"];

        header("Location: inicio.php");
        exit;

    } else {
        $error = "Usuario o clave incorrectos.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Agenda de contactos</h1>
    <form method="post">
         <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>

        <input type="submit" value="Entrar">
    </form>
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>