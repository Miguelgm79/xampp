<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function setup(Request $request, GeminiService $gemini) 
{ 
    $tema = $request->input('tema', 'cultura general'); // valor por defecto 
    $resultado = $gemini->generateWord($tema); 
 
    // Guardamos la palabra en la sesión (encriptada o solo en el servidor) para evitar trampas 
    session(['palabra_ahorcado' => 
strtoupper($resultado['palabra'])]); 
 
    return response()->json([ 
        'pista' => $resultado['pista'], 
        'longitud' => strlen($resultado['palabra']) 
    ]); 
} 
}
