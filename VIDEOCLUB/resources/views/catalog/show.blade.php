@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-sm-4">
        <img src="{{ $pelicula->poster }}" style="height: 200px">
    </div>

    <div class="col-sm-8">
        <h2>{{ $pelicula->title }}</h2>
        <p><strong>Año:</strong> {{ $pelicula->year }}</p>
        <p><strong>Director:</strong> {{ $pelicula->director }}</p>
        <p><strong>Synopsis:</strong> {{ $pelicula->synopsis }}</p>

        {{-- Botón para editar la película --}}
        <a href="{{ url('/catalog/edit/' . $pelicula->id) }}" class="btn btn-warning">
            <i class="fa fa-edit"></i> Editar película
        </a>
        
        {{-- Botón para volver al listado --}}
        <a href="{{ url('/catalog') }}" class="btn btn-outline-secondary">
            Volver al listado
        </a>
    </div>
</div>
@endsection