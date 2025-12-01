<?php
session_start();
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bdoposicion");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$dniA = $_SESSION["dniA"];
/*$sql = "SELECT nombreA FROM alumno WHERE dniA = '$dni'";
$resultado = $conexion->query($sql);
$nombre = $resultado->data_seek();*/

if (isset($_POST['dni'])) {
    if(empty($_POST['dni'])&& empty($_POST['COD_CURSO'])&& empty($_POST['PruebaA'])&& empty($_POST['PruebaB'])&& empty($_POST['Tipo'])&& empty($_POST['Inscripcion'])) {
        $dni = $_POST['dni'];
        $COD_CURSO = $_POST['COD_CURSO'];
        $PruebaA = $_POST['PruebaA'];
        $PruebaB = $_POST['PruebaB'];
        $Tipo = $_POST['Tipo'];
        $Inscripcion = $_POST['Inscripcion'];

        // Comprobar si el usuario existe
        $sql_check = "SELECT * FROM alumno WHERE dni = $dni";
        $stmt = $conexion->prepare($sql_check);
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $resultado = $stmt->get_result();

         if ($resultado->num_rows > 0) {
            $mensaje = "El nombre de dni ya existe.";
        } else {
            // Insertar nuevo usuario
            $sql_insert = "INSERT INTO matricula (dnialumno, codcurso, pruebaA, pruebaB, tipo, inscripcion) VALUES ('$dni', '$COD_CURSO', '$PruebaA', '$PruebaB', '$Tipo', '$Inscripcion')";
            $stmt_insert = $conexion->prepare($sql_insert);

            if ($stmt_insert->execute()) {
                $mensaje = "La matricula del alumno $dni en el curso $COD_CURSO se ha realizado correctamente";
                exit;
            } else {
                $error = "Error al crear el usuario.";
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
    <title>Document</title>
</head>
<body>
    <form action="ejercicio3.php" method="post">
            <h2>Alumno: <?php echo $dniA; ?></h2>
            
            <label for="dni">dni:</label>
            <input type="text" id="dni" name="dni" required><br><br>

            <label for="COD_CURSO">COD CURSO:</label>
            <input type="text" id="COD_CURSO" name="COD_CURSO" required><br><br>

            <label for="PruebaA"> Prueba A:</label>
            <input type="text" id="PruebaA" name="PruebaA" required><br><br>

            <label for="PruebaB"> Prueba B:</label>
            <input type="text" id="PruebaB" name="PruebaB" required><br><br>

            <label for="Tipo"> Tipo:</label>
            <input type="text" id="Tipo" name="Tipo" required><br><br>

            <label for="Inscripcion"> Inscripcion:</label>
            <input type="text" id="Inscripcion" name="Inscripcion" required><br><br>


            <input type="submit" value="Guardar">

            <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
</body>
</html>