@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de Sesión</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-120">

    <div class="card text-center" style="width: 380px; border-radius: 15px;">
        
        <h2 class="mb-3">Contador de Sesión</h2>

        <h1 class="display-3 fw-bold text-primary my-4">
            {{ $contador }}
        </h1>

        <div class="d-grid gap-3">

            <form method="POST" action="{{ url('/sesion/incrementar') }}">
                @csrf
                <button class="btn btn-success btn-lg ">
                    ➕ Incrementar
                </button>
            </form>

            <form method="POST" action="{{ url('/sesion/decrementar') }}">
                @csrf
                <button class="btn btn-warning btn-lg ">
                    ➖ Decrementar
                </button>
            </form>

            <form method="POST" action="{{ url('/sesion/reset') }}">
                @csrf
                <button class="btn btn-danger btn-lg ">
                    🔄 Resetear
                </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>
@endsection