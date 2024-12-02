<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagosApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pago::orderBy('fecha_compra','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pago = new Pago();
        $pago->id_usuario = $request->id_usuario;
        $pago->fecha_compra = $Carbon::now()->format('Y-m-d H:i:s');
        $pago->save();
        return $pago;
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        return $pago;
    }

    public function update(Request $request, Pago $pago)
    {
        // $pago->id_usuario = $request->id_usuario;
        // $pago->fecha_compra = $Carbon::now()->format('Y-m-d H:i:s');
        // $pago->save();
        // return $pago;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        // return $pago->delete();
    }
}
