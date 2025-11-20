<?php
$conexion = new mysqli("localhost", "root", "", "bdsimon");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : "";
    $clave1 = isset($_POST['clave1']) ? trim($_POST['clave1']) : "";
    $clave2 = isset($_POST['clave2']) ? trim($_POST['clave2']) : "";

    if($clave1 !== $clave2) {
        $mensaje = "Las contraseñas no son iguales vuelve a intantarlo";
    }else{
         // Comprobar si el usuario existe
        $sql_check = "SELECT * FROM usuarios WHERE Nombre = ?";
        $stmt = $conexion->prepare($sql_check);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

         if ($resultado->num_rows > 0) {
            $mensaje = "El nombre de usuario ya existe.";
        } else {
            // Insertar nuevo usuario
            $sql_insert = "INSERT INTO usuarios (Nombre, Clave, Rol) VALUES (?, ?, 0)";
            $stmt_insert = $conexion->prepare($sql_insert);
            $stmt_insert->bind_param("ss", $usuario, $clave1);

            if ($stmt_insert->execute()) {
                header("Location: login.php?registro=ok");
                exit;
            } else {
                $mensaje = "Error al crear el usuario.";
            }
    }
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: white;
            padding: 30px;
            width: 320px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        input[type="submit"] {
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="crearCuenta.php" method="post">
            <h2>Crear Cuenta</h2>

             <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="clave1">Nueva contraseña:</label>
            <input type="password" id="clave1" name="clave1" required>

            <label for="clave2">Confirme contraseña:</label>
            <input type="password" id="clave2" name="clave2" required>

            <input type="submit" value="Crear Cuenta">
        </form>
    </div>
</body>
</html>
