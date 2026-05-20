<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mayor</title>
</head>
<body>
    <div class="container">
        <img src="{{ $cartas }}" alt="cartas" width="200" height="300">
        <h3>Aciertos {{ $aciertos }}/5</h3>
        @if (session('mensaje_victoria'))
            <div>
                <h1>{{ session('mensaje_victoria') }}</h1>
            </div>
        @endif
        <form action="{{ route('mayor.jugar') }}" method="POST">
            @csrf
            <input type="hidden" name="tipo" value="jugarTurno">
            <button type="submit" name="tipo" value="jugarTurno">jugarTurno</button>
        </form>
        
        <form action="{{ route('mayor.reiniciar') }}" method="POST">
            @csrf
            <button type="submit">Reiniciar Partida</button>
        </form>
    </div>
</body>
</html>
