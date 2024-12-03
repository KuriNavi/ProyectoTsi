
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto tsi</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script src="{{asset('js/agenda.js')}}" defer></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link href="{{asset('css/bootstrap-custom2.min.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    

    

  </head>
  <body class="" style="">
<div class="container-fluid min-vh-100 d-flex flex-column justify-content-lg-center bg-accent2" >
    <div class="row bg-accent2">
        <div class="col-6 g-4  offset-3 " >
            <div class="row bg-white d-flex justify-content-between bg-accent2">
                <!-- formulario -->
                <div class="col-5  bg-accent3 shadow rounded" >
                    <hr>
                    <h4>Iniciar Sesion</h4>
                    
                    <div class="card bg-accent3" >
                        <div class="card-body">
                            <form method="POST" action="{{route('usuarios.login')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Correo Electronico</label>
                                    <input type="text" id="correo" name="correo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    @if ($errors->hasBag('default') && $errors->has('login'))
                    <div class="alert alert-warning">
                        {{ $errors->first('login')}}
                    </div>
                    @endif


                </div>
                <div class="col-2 bg-accent2"></div>
                <!-- Registro -->
                <div class="col-5  bg-info" >
                    <hr>
                    <h4>Registro</h4>
                    <div class="card bg-info" >
                        <div class="card-body">
                            <form method="POST" action="{{route('usuarios.store')}}">
                                @csrf
                                <div class="mb3">
                                    <label for="nombre_usuario"> Nombre De Usuario </label>
                                    <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Correo Electronico</label>
                                    <input type="text" id="correo" name="correo"  class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" id="password" name="password"  class="form-control">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Registrarse</button>
                                </div>
                            </form>
                            @if ($errors->any() && !$errors->has('login'))
                        <div class="alert alert-danger">
                            
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        </div>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>