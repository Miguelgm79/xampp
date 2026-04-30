<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{
    // Mostrar la vista
    public function index(Request $request)
    {
        $contador = session('contador', 0);
        return view('sesion', compact('contador'));
    }

    // Incrementar
    public function incrementar(Request $request)
    {
        $contador = session('contador', 0);
        $contador++;
        session(['contador' => $contador]);

        return redirect('/sesion');
    }

    // Decrementar
    public function decrementar(Request $request)
    {
        $contador = session('contador', 0);
        $contador--;
        session(['contador' => $contador]);

        return redirect('/sesion');
    }

    // Resetear
    public function reset(Request $request)
    {
        session(['contador' => 0]);

        return redirect('/sesion');
    }
}