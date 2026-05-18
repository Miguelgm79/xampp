<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Cartas: Mayor o Menor</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #2c3e50; color: white; padding-top: 50px; }
        .tablero { display: flex; justify-content: center; align-items: center; gap: 30px; margin-top: 40px; }
        .carta-img { width: 200px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.5); }
        .btn { padding: 15px 30px; font-size: 18px; cursor: pointer; border: none; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .btn-menor { background-color: #e74c3c; color: white; }
        .btn-mayor { background-color: #2ecc71; color: white; }
        .btn:hover { opacity: 0.8; transform: scale(1.05); }
        .marcador { font-size: 24px; margin-bottom: 20px; }
        .alerta { padding: 15px; margin: 20px auto; width: 50%; border-radius: 5px; font-size: 18px; }
        .alerta-success { background-color: #27ae60; }
        .alerta-error { background-color: #c0392b; }
        .alerta-win { background-color: #f1c40f; color: black; font-weight: bold; font-size: 22px; }
    </style>
</head>
<body>

    <h1>Juego: ¿Mayor o Menor?</h1>

    <div class="marcador">
        Aciertos seguidos: <strong>{{ $aciertos }} / 5</strong>
    </div>

    <!-- Mostrar mensajes de error, éxito o victoria -->
    @if(session('mensaje'))
        <div class="alerta alerta-{{ session('tipo') }}">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- Formulario con los botones a cada lado de la carta -->
    <form action="{{ route('juego.adivinar') }}" method="POST">
        @csrf
        <div class="tablero">
            
            <!-- Botón Izquierdo: MENOR -->
            <button type="submit" name="eleccion" value="menor" class="btn btn-menor">
                ◀ Será Menor
            </button>

            <!-- Imagen de la carta actual -->
            <div class="carta">
                <img src="{{ asset('images/' . $imagen_carta) }}" alt="Carta" class="carta-img">
            </div>

            <!-- Botón Derecho: MAYOR -->
            <button type="submit" name="eleccion" value="mayor" class="btn btn-mayor">
                Será Mayor ▶
            </button>

        </div>
    </form>

</body>
</html>
