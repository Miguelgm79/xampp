<?php


function pintar_emoji($cantidad) {

    $emoji = array(
        "emoji/OIP0.jfif",
        "emoji/OIP1.jfif",
        "emoji/OIP2.jfif",
        "emoji/OIP3.jfif",
        "emoji/OIP4.jfif"
    );

    echo "<div style='display:flex; gap:10px; margin:20px;'>";

    for ($i = 0; $i < $cantidad; $i++) {
        $num_emoji = rand(0, 4);
        echo '<img src="' . $emoji[$num_emoji] . '" style="width:100px;">';
    }

    echo "</div>";
}



?>