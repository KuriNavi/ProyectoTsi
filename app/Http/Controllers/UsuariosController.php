<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsuariosRequest;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index(){
        $usuario = Usuario::all();
        return view('usuario.index',compact('usuario'));
    }

    public function create(){
        return view('usuarios.create');
    }

    public function store(UsuariosRequest $request){
        $usuario = new Usuario();
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo = $request->correo;
        $usuario->password = Hash::make($request->password);
        $usuario->plus = false;
        $usuario->id_fondo = 1;
        $usuario->save();

        return redirect()->route('login')->with('sucess', 'Usuario Registrado con exito');

    }

    public function update(Usuario $usuario, UsuariosEdRequest $request){
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->correo = $request->correo;
        
        return redirect()->route('actividades.index');
    }
    
    public function login(Request $request){
        Auth::logout();

        $credenciales = [
            'correo' =>$request->correo,
            'password' =>$request->password,
        ];

        if (Auth::attempt($credenciales)){
            $request->session()->regenerate();
            return redirect()->route('home.index');

        }else{
            return back()->withErrors(['login' => 'Correo o Contraseña incorrecta'])->withInput();

        }

    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login');

    }

    public function destroy(Usuario $usuario){
        $usuario->delete();
        return redirect()->route('usuario.index');        
    }

    public function showChangePasswordForm() {
        return view('usuario.cambiar-password');
    }
    
    public function cambiarPassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Por favor, ingrese su contraseña actual.',
            'new_password.required' => 'Por favor, ingrese una nueva contraseña.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
        ]);
    
        $usuario = Auth::user();
    
        if (!Hash::check($request->current_password, $usuario->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }
    
        $usuario->password = $request->new_password;
        $usuario->save();
    
        return redirect()->route('home.opciones')->with('success', 'Contraseña actualizada con éxito ');
    }

    public function showChangeUsernameForm() {
        return view('usuario.cambiar-usuario');
    }
    
    public function changeUsername(Request $request) {
        $request->validate([
            'nuevo_usuario' => 'required|min:3|max:20|unique:usuarios,nombre_usuario',
        ], [
            'nuevo_usuario.required' => 'Por favor, ingrese un nuevo nombre de usuario.',
            'nuevo_usuario.min' => 'El nuevo nombre de usuario debe tener al menos 3 caracteres.',
            'nuevo_usuario.max' => 'El nuevo nombre de usuario no puede exceder los 20 caracteres.',
            'nuevo_usuario.unique' => 'Este nombre de usuario ya está en uso.',
        ]);
    
        $usuario = Auth::user();
        $usuario->nombre_usuario = $request->nuevo_usuario;
        $usuario->save();
    
        return redirect()->route('home.opciones')->with('success', 'Nombre de usuario actualizado con éxito');
    }

}
