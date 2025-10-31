<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_circulos = (int)$_POST["num_circulos"];

    // Guardamos la elección
    $_SESSION["num_circulos"] = $num_circulos;

    // Pasamos a generar la combinación
    header("Location: Inicio.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Seleccionar dificultad</title>
</head>
<body>
    <h2>Hola jugador 1:</h2>
    <h3>Elige el número de círculos</h3>

    <form method="post">
        <label for="num_circulos">Número de círculos:</label>
        <select name="num_circulos" id="num_circulos" required>
            <option value="4">Fácil (4 círculos)</option>
            <option value="5">Medio (5 círculos)</option>
            <option value="6">Difícil (6 círculos)</option>
            <option value="7">Muy difícil (7 círculos)</option>
            <option value="8">Experto (8 círculos)</option>
        </select>
        <br><br>
        <input type="submit" value="Empezar">
    </form>
</body>
</html>
