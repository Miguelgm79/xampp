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

    public function getEdit($id)
    {
        // Buscamos por ID para editar
        $pelicula = Movie::findOrFail($id);
        
        return view('catalog.edit')
                ->with('pelicula', $pelicula);
    }
	
}


