@extends('templates.template')
@section('contenido-principal')
<div id="categorias" class="col-12 col-md-3 p-2">
    <h4>Categorías</h4>
    <ul class="list-group">
        @foreach($categorias as $categoria)
            <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #{{ $categoria->color }};">
                {{ $categoria->nombre_categoria }}
            </li>
        @endforeach
        <button type="button" class="btn btn-accent3 shadow-lg border border-accent2 rounded" id="btnAgregarCategoria"> Deseas Agregar una categoria?</button>

    </ul>
</div>

<div id="agenda" class="col-12 col-md-5  p-2">
</div>
@endsection