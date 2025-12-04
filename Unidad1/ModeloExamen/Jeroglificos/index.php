<?php
session_start();

// 1. Configuración de la Conexión
$conexion = new mysqli("localhost", "Jugador", "", "jeroglifico");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos.");
}

// 2. Manejo de Mensajes de Error de la Sesión
$error = "";
if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]); // Se limpia el error después de mostrarlo
}

// 3. Procesamiento del Formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['clave'])) {
    
    // Asignación de variables POST (ya están a salvo con la parametrización)
    $usuario = $_POST['usuario'];
    $clave   = $_POST['clave'];

    // Consulta Parametrizada
    $sql = "SELECT * FROM jugador WHERE login = ? AND clave = ?";

    // Paso 1: Preparar la consulta
    if ($stmt = $conexion->prepare($sql)) {

        // Paso 2: Ligar los parámetros (ss = dos strings)
        $stmt->bind_param("ss", $usuario, $clave);

        // Paso 3: Ejecutar la consulta
        $stmt->execute();

        // Paso 4: Obtener el resultado
        $resultado = $stmt->get_result();
        
        // Cierre de sentencia para liberar recursos
        $stmt->close(); 

        // 4. Verificación del Resultado
        if ($resultado && $resultado->num_rows === 1) {
            
            $_SESSION["usuario"] = $usuario

            header("Location: inicio.php");
            exit;
        } else {
            // Fracaso: Guardar el error y redirigir
            $_SESSION["error"] = "Usuario o clave incorrectos.";
            header("Location: index.php");
            exit;
        }
    } else {
        // Error de preparación de la consulta
        error_log("Error al preparar la consulta de login: " . $conexion->error);
        $_SESSION["error"] = "Ha ocurrido un error interno. Inténtelo de nuevo.";
        header("Location: index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
</head>
<body>
    <form method="post" action="index.php">
        <h2>Inicio de Sesión</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo ($error); ?></p>
        <?php endif; ?>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>