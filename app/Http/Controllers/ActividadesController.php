<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ActividadesRequest;
use Carbon\Carbon;

class ActividadesController extends Controller
{
    //

    
    public function index(Actividad $actividad){
        $actividades = Actividad::where('id_usuario', Auth::id())->get()->map(function ($actividad) {
            return [
                'id' => $actividad->id,
                'title' => $actividad->nombre_actividad,
                'description' => $actividad->descripcion,
                'start' => Carbon::parse($actividad->fecha_hora_inicio)->toIso8601String(),
                'end' => Carbon::parse($actividad->fecha_hora_termino)->toIso8601String(),
                'recordatorio' => Carbon::parse($actividad->recordatorio)->toIso8601String()
            ];
        });

        return response()->json($actividades);

    } 


    public function store(ActividadesRequest $request){
        $fechainicio = Carbon::parse($request->fecha_hora_inicio)->timezone('America/Santiago');
        $fechacierre = Carbon::parse($request->fecha_hora_termino)->timezone('America/Santiago');

        //hasta auth()->id() rescata las actividades del usuario logeado o autenticado
        //hasta el ($request) {} es un bloque anonimo que permite establecer multiples condiciones que deben cumplirse
        //$query siendo un objeto y use ($request) siendo usado para poder acceder a esa variable
        //whereBetween verifica si un valor esta entre los valores que se le da
        // se usa para ambos tanto inicio como final, esto para que no se sobreponga una actividad con otra
        $actividadExistente = Actividad::where('id_usuario', auth()->id())
        ->where(function($query) use ($fechainicio, $fechacierre) {
            $query->where('fecha_hora_inicio', $fechainicio);
                  
        })
        ->exists();

        if ($actividadExistente) {
            return response()->json(['errors' => ['fecha_hora_inicio' => ['Ya existe una actividad programada entre este horario']]], 422);
        }
        $recordatorio = null;
        if ($request->recordatorio) {
        
         $recordatorio = Carbon::parse($request->fecha_hora_inicio)->copy()->subMinutes($request->recordatorio);
        }

        $actividad= new Actividad();
        $actividad->id_usuario = auth()->id();
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->descripcion = $request->descripcion;
        $actividad->id_categoria = $request->id_categoria;
        $actividad->fecha_hora_inicio = Carbon::parse($request->fecha_hora_inicio)->timezone('America/Santiago');
        $actividad->fecha_hora_termino = Carbon::parse($request->fecha_hora_termino)->timezone('America/Santiago');
        $actividad->recordatorio = $recordatorio;
        $actividad->save();

        return redirect()->route('home.index')->with('success', 'Actividad creada exitosamente!');


    }

    public function destroy(Request $request){
        
    }


}
