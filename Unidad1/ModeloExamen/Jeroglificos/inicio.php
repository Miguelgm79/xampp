<?php
session_start();

// 1. Configuración de la Conexión
$conexion = new mysqli("localhost", "Jugador", "", "jeroglifico");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos.");
}


if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
$usuario = $_SESSION["usuario"];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['respuesta'])) {

    $respuesta = trim($_POST['respuesta']);

    $sql = "INSERT INTO respuestas (fecha, login, hora, respuesta) VALUES (CURDATE(), ?, CURTIME(), ?)";
  
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ss", $usuario, $respuesta);
        $stmt->execute();
        $stmt->close();

        $_SESSION["respuesta"] = $respuesta;
    } else {
        error_log("Error prepare insert: " . $conexion->error);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<body>
  <h1>Bienvenido, <?php echo ($usuario); ?></h1>
  <img src="img\20240216.jpg" alt="Jeroglifico">
  <form action="" method="post">
    <label for="respuesta">Agrega la solucion:</label>
        <input type="text" id="respuesta" name="respuesta" required>
         <br><input type="submit" value="Enviar">
  </form>
  <br>
  <a href="punto.php">Ver puntos por jugador</a><br>
  <a href="resultado.php">Ver resultados del dia</a>

</body>
</html>
