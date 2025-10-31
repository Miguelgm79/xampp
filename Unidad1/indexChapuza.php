<?php

$arraynum = array(5,8,9,1,3,2);
$arraystring = array('hola', 'adios', 'pepe', 'juan', 'perro', 'gato');

print_r($arraynum);
print_r($arraystring);

echo("<br><br><br>");

sort($arraynum, SORT_NUMERIC);
sort($arraystring, SORT_STRING);

print_r($arraynum);
print_r($arraystring);

$arrayPalabra = array('this', 'is'. 'a', 'sentence', 'with', 'seven', 'words');
$arrayPalabra = array('', '');
?>