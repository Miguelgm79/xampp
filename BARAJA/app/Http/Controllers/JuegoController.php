<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
    // Aquí está el array explícito de tus 12 cartas de bastos
    private $cartas = [
        1  => 'basto1.jpg',
        2  => 'basto2.jpg',
        3  => 'basto3.jpg',
        4  => 'basto4.jpg',
        5  => 'basto5.jpg',
        6  => 'basto6.jpg',
        7  => 'basto7.jpg',
        8  => 'basto8.jpg',
        9  => 'basto9.jpg',
        10 => 'basto10.jpg',
        11 => 'basto11.jpg',
        12 => 'basto12.jpg'
    ];

    public function index()
    {
        
        if (!session()->has('mensaje')) {
            $this->reiniciarJuego();
        }

        $valorActual = session('valor_carta');
        $imagenActual = $this->cartas[$valorActual]; 

        return view('juego', [
            'imagen_carta' => $imagenActual,
            'aciertos' => session('aciertos')
        ]);
    }

    public function adivinar(Request $request)
    {
        $request->validate(['eleccion' => 'required|in:mayor,menor']);

        $valorAnterior = session('valor_carta');
        
        // Obtenemos todas las claves (los números del 1 al 12) del array
        $valoresDisponibles = array_keys($this->cartas);
        
        // Sacamos un nuevo valor aleatorio del array, asegurando que no sea el mismo
        do {
            $nuevoValor = $valoresDisponibles[array_rand($valoresDisponibles)];
        } while ($nuevoValor == $valorAnterior);

        $eleccion = $request->eleccion;
        $aciertos = session('aciertos');
        $esMayor = $nuevoValor > $valorAnterior;

        // Comprobamos si acertó
        if (($eleccion == 'mayor' && $esMayor) || ($eleccion == 'menor' && !$esMayor)) {
            $aciertos++;
            $mensaje = "¡Acertaste! La nueva carta es el $nuevoValor.";
            $tipoMensaje = 'success';
        } else {
            $aciertos = 0; 
            $mensaje = "Fallaste. La carta era el $nuevoValor. La racha vuelve a 0.";
            $tipoMensaje = 'error';
        }

        // Guardamos el nuevo estado en la sesión
        session(['valor_carta' => $nuevoValor]);
        session(['aciertos' => $aciertos]);

        // Si llega a 5 aciertos
        if ($aciertos >= 5) {
            $mensaje = "¡🏆 FELICIDADES! Has conseguido 5 aciertos seguidos. ¡HAS GANADO!";
            $tipoMensaje = 'win';
            $this->reiniciarJuego();
        }

        return redirect()->route('juego.index')->with([
            'mensaje' => $mensaje,
            'tipo' => $tipoMensaje
        ]);
    }

    private function reiniciarJuego()
    {
        // Coge un valor aleatorio de las claves del array
        $valoresDisponibles = array_keys($this->cartas);
        $valorAleatorio = $valoresDisponibles[array_rand($valoresDisponibles)];
        
        session(['valor_carta' => $valorAleatorio]);
        session(['aciertos' => 0]);
    }
}