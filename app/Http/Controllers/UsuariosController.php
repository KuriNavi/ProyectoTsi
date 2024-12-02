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

}
