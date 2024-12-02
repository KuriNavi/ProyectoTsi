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
        $fondo = Fondo::where('id', $user->id)->get();
        

        $categorias = Categoria::where('id_usuario', $user->id) ->orWhere('id_usuario', 1)->get();
        $actividades = Actividad::where('id_usuario', $user->id)->get()->map(function ($actividad) {
            return [
                'id' => $actividad->id,
                'title' => $actividad->nombre_actividad,
                'description' => $actividad->descripcion,
                'start' => \Carbon\Carbon::parse($actividad->fecha_hora_inicio)->toIso8601String(),
                'end' => \Carbon\Carbon::parse($actividad->fecha_hora_termino)->toIso8601String(),
            ];
        });

        return view('home.index', ['actividades' => $actividades, 'categorias' => $categorias, 'fondos' => $fondo],);
    }
    

    public function login(){

        return view('login');
    }
    
}
