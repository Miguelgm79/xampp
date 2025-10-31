<?php
/* Mostrar tdos los arrays en pantalla */
 /*$gente = array (
    'Los Simpson' => array(
        'Padre' => 'Homer',
        'Madre' => 'Marge',
        'Hijos' => array('Bart', 'Lisa', 'Maggie')
    ),
    'Los Griffin' => array(
        'Padre' => 'Peter',
        'Madre' => 'Lois',
        'Hijos' => array('Chris', 'Meg', 'Stewie')
    )
);

foreach ($gente as $indice => $familia) {
    echo "<h3>$indice</h3>";
    foreach ($familia as $indice2 => $valor) {
        if (is_array($valor)) {
            echo "$indice2 <br>";
            foreach ($valor as $hijos) {
                echo "$hijos<br>";
            }
        } else {
            echo "$indice2: $valor<br>";
        }
    }
} */

/* Listas y tabulaciones en el array de Hijos */     
$gente = array(
    'Los Simpson' => array(
        'Padre' => 'Homer',
        'Madre' => 'Marge',
        'Hijos' => array('Bart', 'Lisa', 'Maggie')
    ),
    'Los Griffin' => array(
        'Padre' => 'Peter',
        'Madre' => 'Lois',
        'Hijos' => array('Chris', 'Meg', 'Stewie')
    )
);

foreach ($gente as $familia => $miembros) {
    echo "<h3>$familia</h3>";
    echo "<ul>"; // Lista principal

    foreach ($miembros as $rol => $valor) {
        if (is_array($valor)) {
            echo "<li>$rol:";
            echo "<ul>"; // Sublista para los hijos
            foreach ($valor as $hijo) {
                echo "<li>$hijo</li>";
            }
            echo "</ul></li>";
        } else {
            echo "<li>$rol: $valor</li>";
        }
    }

    echo "</ul><hr>"; // Cierra lista de la familia
}


?>
