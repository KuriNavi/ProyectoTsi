<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Fondo;

class HomeController extends Controller
{
    public function index(){
        
        $user = auth()->user();
        $fondo = Fondo::where('id', $user->id)->first();
        

        $categorias = Categoria::where('id_usuario', $user->id) ->orWhere('id_usuario', 1)->get();
        
        $actividades = Actividad::with('categoria')->get();

        // Mapea las actividades para agregar los colores de las categorías
        $eventos = $actividades->map(function ($actividad) {
            return [
                'id' => $actividad->id,
                'title' => $actividad->nombre_actividad,
                'start' => $actividad->fecha_hora_inicio,
                'end' => $actividad->fecha_hora_termino,
                'description' => $actividad->descripcion,
                'backgroundColor' => isset($actividad->categoria) ? '#' . $actividad->categoria->color : '#ffffff', // Color de la categoría o blanco por defecto
                'borderColor' => isset($actividad->categoria) ? '#' . $actividad->categoria->color : '#000000', // Color de borde de la categoría o negro por defecto
            ];
        });
        

        return view('home.index', ['actividades' =>$actividades, 'categorias' => $categorias, 'fondos' => $fondo],);
    }
    
    public function opciones(){
        $user = auth()->user();
        $fondo = Fondo::where('id', $user->id)->first();

        return view('home.opciones', ['fondos' => $fondo]);
    }

    public function login(){

        return view('login');
    }
    
}
