<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_actividad' => 'required',
            'descripcion' => 'required',
            'id_categoria' => 'required|exists:categorias,id',
            'fecha_hora_inicio' => 'required|date| before:fecha_hora_termino',
            'fecha_hora_termino' => 'required|date|after:fecha_hora_inicio',
            'recordatorio' => 'nullable',
        ];
    }


    public function messages(){
        return [
            'nombre_actividad.required' => 'El nombre de la actividad es necesario',
            'descripcion.required' => 'Se necesita una breve descripcion de la actividad',
            'id_categoria.required' => 'Es necesario seleccionar 1 categoria',
            'id_categoria.exists' => 'La categoria debe existir',
            'fecha_hora_inicio.required' => 'La Fecha y Hora de Inicio son Necesarias',
            'fecha_hora_inicio.date' => 'El Formato de la Fecha y Hora no cumplen con el formato requerido',
            'fecha_hora_inicio.before' => 'La Fecha y hora de inicio deben ser antes que la fecha y hora de termino',
            'fecha_hora_termino.required' => 'La fecha y hora de termino son necesarias',
            'fecha_hora_termino.date' => 'El Formato de la fecha y hora no cumplen con el formato requerido',
            'fecha_hora_termino.after' => 'La fecha y hora de termino deben ser despues de la Fecha y hora de Inicio',
        ];
    }
}
