<?php
/*Ejercicio 2

$alumnos = array(
    'ingles' => array('Basico' => 1, 'Medio' => 6, 'Avanzado' => 3), 
    'Frances' => array('Basico' => 14, 'Medio' => 19, 'Avanzado' => 13), 
    'Aleman' => array('Basico' => 8, 'Medio' => 7, 'Avanzado' => 4), 
    'Ruso' => array('Basico' => 3, 'Medio' => 2, 'Avanzado' => 1));

   

  // Recorremos por idiomas
foreach ($alumnos as $idioma => $niveles) {
    // Recorremos los niveles
    foreach ($niveles as $nivel => $cantidad) {
        echo "El numero de alumnos matriculados en $idioma nivel $nivel son: $cantidad ";
        echo"<br>";

    }
    echo("<br>");
} */


/*Ejercicio 3 

$numerosPares = array(2,4,6,8,10,12,14,16,18,20);

foreach ($numerosPares as $Par => $Num) {
    echo("$Num <br>");
}*/

/*Ejercicio 4  

$matriz = array(); 
    for ($i = 0; $i < 4; $i++){
        for ($j = 0; $j < 4; $j++) {
            $matriz[$i][$j] = random_int(1,1000);
        }
    }

for ($i = 0; $i < 4; $i++){
        for ($j = 0; $j < 4; $j++) {
            echo($matriz[$i][$j]);
            echo(' ');
        }
        echo("<br>");
    }

    echo("<br>");

for ($i = 0; $i < 4; $i++){
        echo($matriz[$i][$i]);
        echo(' ');
    }

    echo("<br>");

for ($i = 0; $i < 4; $i++){
        echo($matriz[$i][3 - $i]);
        echo(' ');
    }*/

/*Ejercicio 5 

$matriz = array(); 

// Generar una matriz de 5 filas y 3 columnas
for ($i = 0; $i < 5; $i++) {         
    for ($j = 0; $j < 3; $j++) {    
        $matriz[$i][$j] = random_int(1, 1000);
    }
}


for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 3; $j++) {
        echo $matriz[$i][$j] . " ";
    }
    echo "<br>";
}

echo "<br>";

for ($j = 0; $j < 3; $j++) {      
    for ($i = 0; $i < 5; $i++) {  
        echo $matriz[$i][$j] . " ";
        
    }
    echo("<br>");
}*/

/*Ejercicio 6*/









?>