<?php
function pintar_circulos($c1, $c2, $c3, $c4) {
    $colores = [$c1, $c2, $c3, $c4];
    echo "<div style='display:flex; gap:10px; margin:20px 0'>";
    foreach ($colores as $color) {
        echo "<div style='width:50px; height:50px; border-radius:50%; background-color:$color;'></div>";
    }
    echo "</div>";
}
?>
