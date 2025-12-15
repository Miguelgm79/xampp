<?php

session_start();

$hn = 'localhost';
$db = 'cartas';
$un = 'root';
$pw = '';


$connection = new mysqli($hn, $un, $pw, $db);
 if ($connection->connect_error) die("Fatal Error");

$error='';


 if (isset($_POST['submit'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['contrasenia'])){
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];
    

    //consulta parametrizada
    $stmt = $connection->prepare("SELECT login FROM jugador WHERE login = ? AND clave = ?");
    
    $stmt->bind_param("ss", $usuario, $contrasenia);
    $stmt->execute();
    $result = $stmt->get_result();

    $fila = $result->fetch_assoc();
    if ($fila) {
        $_SESSION['login'] = $fila ['login'];
         header("Location: mostrarcartas.php");
         exit();
    } else {
         $error = "Usuario o contraseña incorrectos";
    }
     $stmt->close();

    }
 }


    $connection->close();
echo <<<_END
<html>
    <body>
        <h1>Iniciar sesión</h1>
            <form action="index.php" method="post">
                <label for="usuario">Usuario:</label><br>
                <input type="text" name="usuario"><br><br>
                <label for="contrasenia">Contraseña:</label><br>
                <input type="password" name="contrasenia"><br><br>
                <input type="submit" name="submit" value="Entrar">
            </form>
            <p style="color:red">$error</p>
    </body>
</html>
_END;
                                            
?>

