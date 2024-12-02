<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Actividad::orderBy('fecha_hora_inicio')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $actividad = new Actividad();
        $actividad->id_usuario = $request->id_usuario;
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->descripcion = $request->descripcion;
        $actividad->id_categoria = $request->id_categoria;
        $actividad->fecha_hora_inicio = $request->fecha_hora_inicio;
        $actividad->fecha_hora_termino = $request->fecha_hora_termino;
        $actividad->recordatorio= $request->recordatorio;
        $actividad->save();
        return $actividad;
    }

    /**
     * Display the specified resource.
     */
    public function show(Actividad $actividad)
    {
        return $actividad;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actividad $actividad)
    {
        $actividad->nombre_actividad = $request->nombre_actividad;
        $actividad->descripcion = $request->descripcion;
        $actividad->color = $request->color;
        $actividad->fecha_hora_inicio = $request->fecha_hora_inicio;
        $actividad->fecha_hora_termino = $request->fecha_hora_termino;
        $actividad->recordatorio= $request->recoradtorio;
        $actividad->save();
        return $actividad;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actividad $actividad)
    {
        return $actividad->delete();
    }
}
