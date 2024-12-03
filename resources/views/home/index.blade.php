@extends('templates.template')

@section('contenido-principal')

<div class="container-fluid min-vh-100 d-flex flex-column p-0 justify-content-lg-center bg-accent2"style="background-image: url('{{asset('images/' . $fondos->imagen)}}'); background-size: cover; 
    background-repeat: no-repeat; 
    background-position: center;">
    
    <div class="row">
        <div id="agenda" class="col-12 col-md-8 offset-2  p-4">
        </div>
    </div>

    <!-- Botón para activar el Modal -->
    <button type="button" id="abrirModal" class="btn btn-accent1 offset-4 col-5 p-2" data-bs-toggle="modal" data-bs-target="#actividad">
        Agregar Actividad
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="actividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 90%; width: auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form action="{{ route('actividades.store') }}" method="POST">
                        @csrf
                            @if ($errors->any())
                             <div class="alert alert-warning">

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="form-group mb-3">
                            <label for="nombre_actividad" class="form-label">Nombre Actividad</label>
                            <input type="text" class="form-control" name="nombre_actividad" id="nombre_actividad" placeholder="Ingrese el nombre de la actividad">
                            <small id="titleHelp" class="form-text text-muted">Texto de ayuda: Escribe el nombre de la actividad.</small>
                        </div>
        
                        <div class="form-group mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" placeholder="Descripción de la actividad"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_categoria" class="form-label"> Categorías</label>
            
                            <select name="id_categoria" id="id_categoria" class="form-select">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" style="background-color: #{{$categoria->color}}">
                                        {{ $categoria->nombre_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group mb-3">
                            <label for="fecha_hora_inicio">Inicio De Actividad</label>
                            <input type="datetime-local" name="fecha_hora_inicio" class="form-control" id="fecha_hora_inicio" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="form-text text-muted">Seleccione Fecha y Hora De Inicio</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fecha_hora_termino">Termino De Actividad</label>
                            <input type="datetime-local"  name="fecha_hora_termino" class="form-control" id="fecha_hora_termino" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="form-text text-muted">Seleccione Fecha y Hora de Termino</small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="recordatorio">Recordatorio</label>
                            <select name="recordatorio" id="recordatorio" class="form-control">
                                <option value="" selected> Sin Recordatorio </option>
                                <option value="10">10 minutos antes</option>
                                <option value="30">30 minutos antes</option>
                                <option value="60">1 hora antes</option>
                                <option value="120">2 horas antes</option>
                                <option value="1440">1 día antes</option>
                                <option value="2880">2 días antes</option>
                            </select>
                            <small  class="form-text text-muted">(opcional) Escoger Un Recordatorio para la actividad</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

@endsection
