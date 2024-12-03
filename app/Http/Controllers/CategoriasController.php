<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index(){
       $categorias = Categoria::where('id_usuario', auth()->id()) ->orWhere('id_usuario', 1)->get();

       return view('categorias.index', ['categorias' => $categorias]);
    }
    public function store(Request $request){

        
    }
}
