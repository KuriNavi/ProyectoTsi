<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuario::orderBy('id_rol')->orderBy('nombre_usuario')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo = $request->correo;
        $usuario->password = Hash::make($request->password);
        $usuario->plus = false;
        $usuario->id_fondo = 1;
        $usuario->save();
        return $usuario;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        \Log::info('Entrando en el método login con datos:', $request->all());
        $usuario->id_fondo = $request->id_fondo;
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->id_fondo = 1;
        $usuario->save();
        return $usuario;
    }
    //Cambiar contrasena
    public function password(Request $request, Usuario $usuario)
    {
        $usuario->password = Hash::make($request->password);
        return $usuario;
    }
    //Actualizar a version plus - Compra de plus
    public function plus(Request $request, Usuario $usuario)
    {
        $usuario->plus = true;
        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        return $usuario->delete();
    }


    public function login(Request $request){
        \Log::info('Entrando en el método login con datos:', $request->all());
        
        $validarInformacion = $request->validate([
            'correo' => 'required|email',
            'password' => 'required|min:5'
        ]);
        $usuario = Usuario::where('correo', $request->correo)->first();
        if ($usuario && Hash::check($request->password, $usuario->password)) {
            return response()->json([
                'usuario' => $usuario
            ], 200);
        } else {
            return response()->json([
                'las credenciales son incorrectas'
            ], 401);

        }

    }
    public function updateDeTodo(Request $request, Usuario $usuario)
    {
        \Log::info('Entrando en el método login con datos:', $request->all());
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo = $request->correo;
        $usuario->password = Hash::make($request->password);
        $usuario->id_fondo = $request->id_fondo;
        $usuario->id_rol = $request->id_rol;
        $usuario->save();
        return $usuario;
    }
}
