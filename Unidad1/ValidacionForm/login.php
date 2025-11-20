<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bdvalform");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];
    $email = trim($_POST['email']);
    $website = trim($_POST['website']);
    $comentarios = trim($_POST['comentarios']);
    $genero = $_POST['genero'];

    // Validar contraseñas
    if ($clave1 !== $clave2) {
        die("Las contraseñas no coinciden.");
    }

    // Encriptar contraseña
    $claveHash = password_hash($clave1, PASSWORD_DEFAULT);

    // Validar que el usuario no exista
    $stmt = $conexion->prepare("SELECT cod_usu FROM usuarios WHERE nombre=? OR email=?");
    $stmt->bind_param("ss", $usuario, $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        die("El usuario o email ya existe.");
    }

    // Insertar nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, contraseña, email, website, genero, comentarios) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $usuario, $claveHash, $email, $website, $genero, $comentarios);

    if ($stmt->execute()) {
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        echo "Error al registrar: " . $conexion->error;
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
    <form method="post" action="estadisticas.php">
        <h2>Registro de Usuario</h2>

        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br> 

        <label for="clave1">Contraseña:</label><br>
        <input type="password" id="clave1" name="clave1" required><br>

        <label for="clave2">Confirme contraseña:</label><br>
        <input type="password" id="clave2" name="clave2" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br> 

        <label for="website">Website:</label><br>
        <input type="url" id="website" name="website"><br> 

        <label for="comentarios">Comentarios:</label><br>
        <textarea id="comentarios" name="comentarios"></textarea><br>

        <p>Género:</p>
        <input type="radio" id="mujer" name="genero" value="Mujer" required>
        <label for="mujer">Mujer</label><br>

        <input type="radio" id="hombre" name="genero" value="Hombre" required>
        <label for="hombre">Hombre</label><br><br>

        <input type="submit" value="Registrarse">
    </form>

</body>
</html>