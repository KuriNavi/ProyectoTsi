<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
    public function index(){
       $categorias = Categoria::where('id_usuario', auth()->id()) ->orWhere('id_usuario', 1)->get();

       return view('home.index', ['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|max:30',
            'color' => 'required|size:6|regex:/^[A-Fa-f0-9]{6}$/',
        ]);

        $categoria = new Categoria();
        $categoria->id_usuario = Auth::id();
        $categoria->nombre_categoria = $request->nombre_categoria;
        // $categoria->color = $request->str_replace('#', '', $color);
        $categoria->color = $request->color;
        $categoria->save();

        return redirect()->route('home.index')->with('success', 'Categoría agregada con éxito');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('home.index')->with('success', 'Categoría eliminada con éxito');
    }
}
