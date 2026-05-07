<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    // Método para mostrar la vista por primera vez (vacía)
    public function index()
    {
        return view('calculadora');
    }

    // Metodo para procesar el calculo
    public function calcular(Request $request)
    {
        //validamos que lo campos sean numericos
        $request->validate([
            'n1' => 'required|numeric',
            'n2' => 'required|numeric',
            'operador' => 'required|string'
        ]);

        $n1 = $request->input('n1');
        $n2 = $request->input('n2');
        $operador = $request->input('operador');
        $resultado = null;
        $error = null;

        //switch con las funciones de la calculadora segun el boton 
        switch ($operador) {
            case '+':
                $resultado = $n1 + $n2;
                break;
            case '-':
                $resultado = $n1 - $n2;
                break;
            case 'x':
                $resultado = $n1 * $n2;
                break;
            case '÷':
                if ($n2 == 0) {
                    $error = "Error: Division por cero";
                }else{
                    $resultado = $n1 / $n2;
                }
                break;
            case '%':
                if ($n2 == 0) {
                    $error = "Error: Division por cero";
                }else{
                    $resultado = $n1 % $n2;
                }
                break;
            case 'x^n':
                // Exponente (N1, elevado a N2)
                $resultado = pow($n1, $n2);
                break;
            case '√n':
                // Raíz cuadrada (Solo usa N1, ignora N2)
                if ($n1 < 0) {
                    $error = "Error: Raíz de número negativo";
                } else {
                    $resultado = sqrt($n1);
                }
                break;
        }

        //Volvemos a la vista de la calculadora
        return view('calculadora', [
            'resultado' => $resultado,
            'n1' => $n1,
            'n2' => $n2,
            'resultado' => $error

        ]);
    }
}
