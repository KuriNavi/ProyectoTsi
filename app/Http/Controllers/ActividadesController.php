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
        $actividades = Actividad::with('categoria')->get();

        // Mapea las actividades para agregar los colores de las categorías
        $eventos = $actividades->map(function ($actividad) {
            return [
                'title' => $actividad->nombre_actividad,
                'start' => $actividad->fecha_hora_inicio,
                'end' => $actividad->fecha_hora_termino,
                'description' => $actividad->descripcion,
                'backgroundColor' => isset($actividad->categoria) ? '#' . $actividad->categoria->color : '#ffffff', // Color de la categoría o blanco por defecto
                'borderColor' => isset($actividad->categoria) ? '#' . $actividad->categoria->color : '#000000', // Color de borde de la categoría o negro por defecto
            ];
        });

        return response()->json($eventos);

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

    public function update(ActividadesRequest $request, $id)
    {
            // Buscar la actividad a editar
            $actividad = Actividad::where('id', $id)
                ->where('id_usuario', auth()->id()) // Asegurarse de que pertenece al usuario autenticado
                ->first();

            if (!$actividad) {
                return response()->json(['error' => 'Actividad no encontrada'], 404);
            }

            // Validar que no se solapen horarios de otras actividades
            $fechainicio = Carbon::parse($request->fecha_hora_inicio)->timezone('America/Santiago');
            $fechacierre = Carbon::parse($request->fecha_hora_termino)->timezone('America/Santiago');
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

            // Actualizar la actividad
            $actividad->nombre_actividad = $request->nombre_actividad;
            $actividad->descripcion = $request->descripcion;
            $actividad->id_categoria = $request->id_categoria;
            $actividad->fecha_hora_inicio = $fechainicio;
            $actividad->fecha_hora_termino = $fechacierre;
            $actividad->recordatorio = $recordatorio;
            $actividad->save();

            return response()->json(['success' => 'Actividad actualizada exitosamente']);
    }

    public function destroy(Request $request){

        
    }


}
