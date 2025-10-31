<?php

/* 
Ejercicio 1

$num1 = random_int(1, 1000);
$num2 = random_int(1, 1000);

if ($num1 === $num2) {
    $multi = $num1*$num2;
    echo "La multiplicacion es: $multi";
} elseif ($num1 > $num2) {
    $rest = $num1 - $num2;
    echo "la resta es: $rest";
} elseif ($num1 < $num2) {
    $sum = $num1 + $num2;
    echo "la suma es; $sum";
}

*/

/* 
Ejercicio 2

$num1 = 1;
$num2 = 2;
$num3 = 3;

if ($num1 > $num2 && $num1 > $num3 ) {
    echo "El numero mayor es el: $num1";
} elseif  ($num2 > $num1 && $num2 > $num3 ) {
    echo "El numero mayor es el: $num2";
} else {
    echo "el numero mayor es el $num3";
}

*/

/* 
Ejercicio 3 

$horas_trabajo = 45;
$dinero_hora = 10;

if ($horas_trabajo <= 40) {
    $multi_normal = $horas_trabajo*$dinero_hora;
    echo "lo que gano en jornada normal es de: $multi_normal";

} elseif ( $horas_trabajo < 48 && $horas_trabajo > 40) {
    $horas_dobles = $horas_trabajo - 40;
    $multi_doble = (40 + ($horas_dobles * 2) * $dinero_hora);
    echo "lo que gana mas las horas extra son: $multi_doble"; 

}elseif ($horas_trabajo > 48) {
    $horas_dobles1 = 8;
    $hora_triple = $horas_trabajo - 48; 
    $multi_triple = (40 +($horas_dobles1*2) + ($hora_triple*3) *$dinero_hora);
    echo "lo que se gana mas las horas extra dobles y triples son: $multi_triple";
}
*/
/*
 $paper['copier'] = "Copier & Multipurpose";
 $paper['inkjet'] = "Inkjet Printer";
 $paper['laser'] = "Laser Printer";
 $paper['photo'] = "Photographic Paper";
 echo $paper['laser']; 
echo("<br>");
 print_r ($paper);
echo("<br>");
VAR_DUMP($paper);
*/


?>