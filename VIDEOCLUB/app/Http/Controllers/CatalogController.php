<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class CatalogController extends Controller
{
	public function getIndex()
    {
        $peliculas = Movie::all();
        
        return view('catalog.index')
                ->with('arrayPeliculas', $peliculas);
    }

    public function getShow($id)
    {
        $pelicula = Movie::findOrFail($id);
        
        return view('catalog.show')
                ->with('pelicula', $pelicula);
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function postCreate(Request $request)
    {
        // 1. Instanciamos un nuevo objeto del modelo Movie
        $pelicula = new Movie();
        
        // 2. Asignamos los valores recibidos del formulario a las propiedades del objeto
        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year');
        $pelicula->director = $request->input('director');
        $pelicula->poster = $request->input('poster');
        $pelicula->synopsis = $request->input('synopsis');
        $pelicula->rented = $request->input('rented'); // Recogemos el 0 o 1 del select
        
        // Asignamos el valor por defecto para 'rented'
        $pelicula->rented = false; 
        
        // 3. Guardamos en la base de datos
        $pelicula->save();

        // 4. Redirigimos al usuario de vuelta al catálogo general
        return redirect('/catalog');
    }

    public function getEdit($id)
    {
        // Buscamos por ID para editar
        $pelicula = Movie::findOrFail($id);
        
        return view('catalog.edit')
                ->with('pelicula', $pelicula);
    }

    public function putEdit(Request $request, $id)
{
    // 1. Buscamos la película por su ID
    $pelicula = Movie::findOrFail($id);

    // 2. Actualizamos sus propiedades con los datos del request
    $pelicula->title = $request->input('title');
    $pelicula->year = $request->input('year');
    $pelicula->director = $request->input('director');
    $pelicula->poster = $request->input('poster');
    $pelicula->synopsis = $request->input('synopsis');
    $pelicula->rented = $request->input('rented'); // Actualizamos con el nuevo valor

    // 3. Guardamos los cambios en la base de datos
    $pelicula->save();

    // 4. Redirigimos a la vista de detalle de esa película
    return redirect('/catalog/show/' . $id);
}
	
}


