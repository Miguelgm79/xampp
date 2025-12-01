<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bdoposicion");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['dni'])) {
    if(empty($_POST['dni'])){
         $dniA = $_POST['dni'];
    
    // CONSULTA SELECT
    $sql = "SELECT dniA FROM alumno WHERE dniA = '$dniA'";
    $resultado = $conexion->query($sql);

    
    if ($resultado->num_rows == 1) {
        header("Location: ejercicio3.php");
        exit;

    } else {
       // CONSULTA SELECT
        $sql2 = "SELECT dniP FROM profesor WHERE dniP = '$dniA'";
        $resultado2 = $conexion->query($sql2);
        if ($resultado2->num_rows == 1){
            header("location: ejercicio2.php");
            exit;

        }else {
             $error = "DNI incorrecto.";
        }
    }
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
    <form action="" method="post">

     <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>

        <input type="submit" value="Entrar">
    </form>
    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>