<?php
// --- Lógica PHP del resultado ---
$rojos = [1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36];
$negros = [2,4,6,8,10,11,13,15,17,20,22,24,26,28,29,31,33,35];

$resultado = null;
$color_resultado = null;
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $apuesta_tipo = $_POST["apuesta_tipo"];
    $apuesta_valor = $_POST["apuesta_valor"];
    $apuesta = (int) $_POST["apuesta"];
    $resultado = rand(0, 36);

    if ($resultado === 0) {
        $color_resultado = "verde";
    } elseif (in_array($resultado, $rojos, true)) {
        $color_resultado = "rojo";
    } else {
        $color_resultado = "negro";
    }

    $mensaje = "La bola cayó en el número $resultado ($color_resultado)";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>🎡 Ruleta de Casino en PHP</title>
<style>
body {
    background: radial-gradient(circle at center, #004400 0%, #001800 100%);
    color: white;
    text-align: center;
    font-family: Arial, sans-serif;
    overflow-x: hidden;
}
h1 { color: gold; }

form {
    background: rgba(0,0,0,0.6);
    display: inline-block;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
}

input, select, button {
    margin: 6px;
    padding: 8px;
    border-radius: 6px;
    border: none;
}

button {
    background-color: gold;
    color: black;
    font-weight: bold;
    cursor: pointer;
}
button:hover {
    background-color: #ffcc00;
}

/* --- Ruleta --- */
.ruleta-container {
    position: relative;
    margin: 0 auto;
    width: 550px;
    height: 550px;
    border-radius: 50%;
    background: conic-gradient(
        green 0deg 9.72deg,
        red 9.72deg 19.44deg, black 19.44deg 29.16deg,
        red 29.16deg 38.88deg, black 38.88deg 48.6deg,
        red 48.6deg 58.32deg, black 58.32deg 68.04deg,
        red 68.04deg 77.76deg, black 77.76deg 87.48deg,
        red 87.48deg 97.2deg, black 97.2deg 106.92deg,
        red 106.92deg 116.64deg, black 116.64deg 126.36deg,
        red 126.36deg 136.08deg, black 136.08deg 145.8deg,
        red 145.8deg 155.52deg, black 155.52deg 165.24deg,
        red 165.24deg 174.96deg, black 174.96deg 184.68deg,
        red 184.68deg 194.4deg, black 194.4deg 204.12deg,
        red 204.12deg 213.84deg, black 213.84deg 223.56deg,
        red 223.56deg 233.28deg, black 233.28deg 243deg,
        red 243deg 252.72deg, black 252.72deg 262.44deg,
        red 262.44deg 272.16deg, black 272.16deg 281.88deg,
        red 281.88deg 291.6deg, black 291.6deg 301.32deg,
        red 301.32deg 311.04deg, black 311.04deg 320.76deg,
        red 320.76deg 330.48deg, black 330.48deg 340.2deg,
        red 340.2deg 349.92deg, black 349.92deg 360deg
    );
    border: 10px solid #333;
    box-shadow: 0 0 40px #000;
    transition: transform 6s cubic-bezier(.17,.67,.83,.67);
}

.numeros {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    pointer-events: none;
}

.numeros span {
    position: absolute;
    color: white;
    font-size: 20px;
    font-weight: bold;
    transform-origin: center;
    top: 50%;
    left: 50%;
}

/* Bola */
.bola {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 22px;
    height: 22px;
    background: white;
    border-radius: 50%;
    transform: translate(-50%, -250px);
}
</style>
</head>
<body>

<h1>🎰 Ruleta del Casino 🎰</h1>

<form method="post">
    <label>Tipo de apuesta:</label>
    <select name="apuesta_tipo" required>
        <option value="color">Color</option>
        <option value="numero">Número</option>
    </select><br>
    <label>Valor:</label>
    <input type="text" name="apuesta_valor" placeholder="rojo, negro, verde o número" required><br>
    <label>Apuesta (€):</label>
    <input type="number" name="apuesta" min="1" max="100" required><br>
    <button type="submit">🎡 Girar</button>
</form>

<div class="ruleta-container" id="ruleta">
    <div class="numeros" id="numeros"></div>
    <div class="bola" id="bola"></div>
</div>

<?php if ($resultado !== null): ?>
<p style="margin-top:25px; font-size:1.2em;"><?= $mensaje ?></p>
<script>
const ruleta = document.getElementById('ruleta');
const bola = document.getElementById('bola');
const resultado = <?= $resultado ?>;
const gradosPorNumero = 360 / 37;

// Girar ruleta (más vueltas para realismo)
const vueltas = 6 + Math.random() * 2;
const anguloFinal = 360 * vueltas + (resultado * gradosPorNumero);
ruleta.style.transform = `rotate(${anguloFinal}deg)`;

// Bola gira en sentido contrario (más lenta)
bola.animate([
    { transform: 'translate(-50%, -250px) rotate(0deg)' },
    { transform: 'translate(-50%, -250px) rotate(-2160deg)' }
], {
    duration: 6000,
    easing: 'cubic-bezier(.25,.8,.5,1)',
    fill: 'forwards'
});

setTimeout(() => {
    alert("🎯 Resultado: <?= $resultado ?> (<?= $color_resultado ?>)");
}, 6300);
</script>
<?php endif; ?>

<script>
// Colocar números en su posición correcta (uniforme en el borde)
const numerosContainer = document.getElementById('numeros');
const totalNumeros = 37;
for (let i = 0; i < totalNumeros; i++) {
    const num = document.createElement('span');
    num.textContent = i;
    const angle = (i * (360 / totalNumeros)) - 90; // -90 para iniciar en la parte superior
    num.style.transform = `rotate(${angle}deg) translate(0, -240px) rotate(${-angle}deg)`;
    numerosContainer.appendChild(num);
}
</script>

</body>
</html>
