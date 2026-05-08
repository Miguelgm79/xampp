<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculadoraController extends Controller
{
    public function index()
    {
        return view('calculadora');
    }

    public function calcular(Request $request)
    {
        $validated = $request->validate([
            'n1' => ['required', 'numeric'],
            'n2' => ['required', 'numeric'],
            'op' => ['required', 'in:+,-,*,/,%,sqrt,pow'],
        ]);

        $n1 = (float) $validated['n1'];
        $n2 = (float) $validated['n2'];
        $op = $validated['op'];

        $resultado = match($op) {
            '+'    => $n1 + $n2,
            '-'    => $n1 - $n2,
            '*'    => $n1 * $n2,
            '/'    => $n2 != 0 ? $n1 / $n2 : null,
            '%'    => $n2 != 0 ? ($n1 / $n2) * 100 : null,
            'sqrt' => $n1 >= 0 ? sqrt($n1) : null,
            'pow'  => pow($n1, $n2),
        };

        if ($resultado === null) {
            return response()->json([
                'error' => 'Operación inválida (división entre cero o raíz negativa)',
            ], 422);
        }

        return response()->json([
            'resultado' => round($resultado, 8),
            'n1'        => $n1,
            'n2'        => $n2,
            'op'        => $op,
        ]);
    }
}