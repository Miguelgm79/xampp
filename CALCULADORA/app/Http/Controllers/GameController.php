<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GeminiService;

class GameController extends Controller
{
    public function setup(Request $request, GeminiService $gemini) 
{ 
    try {
        $tema = $request->input('tema', 'cultura general');
        $resultado = $gemini->generateWord($tema); 

        session(['palabra_ahorcado' => strtoupper($resultado['palabra'])]);

        return response()->json([ 
            'pista' => $resultado['pista'], 
            'longitud' => strlen($resultado['palabra']) 
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
