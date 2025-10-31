<?php
function pintar_circulos(...$colores) {
    echo "<div style='display:flex; gap:10px; margin:20px 0'>";
    foreach ($colores as $color) {
        echo "<div style='width:50px; height:50px; border-radius:50%; background-color:$color;'></div>";
    }
    echo "</div>";
}
?>
