<?php
session_start();

//Crea un objeto de conexión a MySQL usando la extensión mysqli
$conexion = new mysqli("localhost", "root", "", "bdsimon");

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
    <title>Login</title>
</head>
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
            text-align: left;
            margin-top: -5px;
            margin-bottom: 10px;
        }
    </style>
<body>
    <form method="post">
        <h2>Inicio de Sesion</h2><br>
    <label for="usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" required><br><br>
    <label for="clave">Contraseña: </label>
            <input type="password" id="clave" name="clave" required><br><br>
    <input type="submit" value="Entrar">
    </form>
    <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
</body>
</html>
