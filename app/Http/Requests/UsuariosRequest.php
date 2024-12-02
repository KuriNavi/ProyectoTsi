<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
            'nombre_usuario' => 'required|min:3|max:20', 
            'correo' => 'required|unique:usuarios,correo|max:50|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:6|max:20', 
        ];
    }

    public function messages(){
        return [
            'nombre_usuario.required' => 'Indique un nombre para el usuario',
            'nombre_usuario.min' => 'El Nombre de Usuario debe tener al menos 3 caracteres',
            'nombre_usuario.max' => 'El Nombre de Usuario no puede exceder los 20 caracteres',
            'correo.unique' => 'Este Correo Electronico ya esta registrado',
            'correo.required'=> 'Indique el Correo Electronico',
            'correo.regex' => 'Formato De Correo Electronico No valido',
            'correo.max' => 'El correo no puede exceder los 50 caracteres',
            'password.required' => 'Indique una contraseña para la cuenta ', 
            'password.min' => 'La contraseña debe contar con al menos 6 caracteres', 
            'password.max' => 'La contraseña no puede exceder los 20 caracteres', 
        ];
    }

}
