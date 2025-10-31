<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num_circulos = (int)$_POST["num_circulos"];
    $num_colores = (int)$_POST["num_colores"];
    // Guardamos la elección
   $_SESSION["num_circulos"] = $num_circulos;
    $_SESSION["num_colores"] = $num_colores;

    // Pasamos a generar la combinación
    header("Location: inicio.php");
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
        <label for="num_colores">Número de colores:</label>
        <select name="num_colores" id="num_colores">
            <option value="4">Fácil (4 colores)</option>
            <option value="5">Medio (5 colores)</option>
            <option value="6">Difícil (6 colores)</option>
            <option value="7">Muy difícil (7 colores)</option>
            <option value="8">Experto (8 colores)</option>
        </select>
        <br><br>
        <input type="submit" value="Empezar">
    </form>
</body>
</html>
