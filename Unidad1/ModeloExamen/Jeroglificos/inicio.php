<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

$usuario = $_SESSION["usuario"];
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <h1>hola <?php echo ($usuario); ?></h1>
</body>
</html>
