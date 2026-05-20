<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    private  $cartas = [
            'images/card_back.svg',
            'images/card_cups_01.svg',
            'images/card_cups_02.svg',
            'images/card_cups_03.svg',
            'images/card_cups_04.svg',
            'images/card_cups_05.svg',
            'images/card_cups_06.svg',
            'images/card_cups_07.svg',
            'images/card_cups_08.svg',
            'images/card_cups_9.svg',
            'images/card_cups_10.svg',
            'images/card_cups_11.svg',
            'images/card_cups_12.svg',
            'images/card_clubs_1.svg',
            'images/card_clubs_2.svg',
            'images/card_clubs_3.svg',
            'images/card_clubs_4.svg',
            'images/card_clubs_5.svg',
            'images/card_clubs_6.svg',
            'images/card_clubs_7.svg',
            'images/card_clubs_8.svg',
            'images/card_clubs_9.svg',
            'images/card_clubs_10.svg',
            'images/card_clubs_11.svg',
            'images/card_clubs_12.svg',
            'images/card_coins_1.svg',
            'images/card_coins_2.svg',
            'images/card_coins_3.svg',
            'images/card_coins_4.svg',
            'images/card_coins_5.svg',
            'images/card_coins_6.svg',
            'images/card_coins_7.svg',
            'images/card_coins_8.svg',
            'images/card_coins_9.svg',
            'images/card_coins_10.svg',
            'images/card_coins_11.svg',
            'images/card_coins_12.svg',
            'images/card_sword_1.svg',
            'images/card_sword_2.svg',
            'images/card_sword_3.svg',
            'images/card_sword_4.svg',
            'images/card_sword_5.svg',
            'images/card_sword_6.svg',
            'images/card_sword_7.svg',
            'images/card_sword_8.svg',
            'images/card_sword_9.svg',
            'images/card_sword_10.svg',
            'images/card_sword_11.svg',
            'images/card_sword_12.svg' 
        ];
    
    public function inicializacion()
    {

        if (!session()->has('mensaje')) {
            $this->reiniciar();
        }

        $valorActual = session('valor_carta');
        $imagenActual = $this->cartas[$valorActual]; 

        if (!session()->has('puntos_jugador')) {
            session([
                'puntos_jugador' => 0, 
                'puntos_maquina' => 0

            ]);
        }

        return view('mayor', [
            'cartas' => $imagenActual,
            'puntos_jugador' => session('puntos_jugador'), 
            'puntos_maquina' => session('puntos_maquina'), 
        ]);
    }

        

    

    public function jugar(Request $request) {
        $cartas = $this->cartas();
        $total = count($cartas);

        if (session('ganado', false)) {
            return redirect()->route('mayor.inicializacion');
        }

        $cartaJugador = array_shift($baraja);
        $cartaJugador = array_shift($baraja);

    }

    public function reiniciar() {
        session()->flush(); //borra los datos de la session

        


        if (!session()->has('puntos_jugador')) {
            session([
                'puntos_jugador' => 0, 
                'puntos_maquina' => 0

            ]);
        }

        return redirect()->route('mayor.inicializacion');
    }
}

