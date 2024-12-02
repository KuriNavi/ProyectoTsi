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
  <body class="">
      <nav class="navbar p-0 navbar-expand-lg bg-body-tertiary bg-dark">
        <div class="container-fluid d-flex justify-content-between bg-dark">
            {{-- Mostrar El Usuario, en caso de no estar logeado solo se mostrara un boton de login --}}
            @auth()
                  <a class="navbar-brand d-flex items-align-center bg-accent1 rounded" href="#">
                    <i class="material-icons ">account_circle</i>
                    <i >{{Auth::user()->nombre_usuario}} </i>
                    
                    
                  </a>
            @endauth



          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav bg-accent1 rounded">          
              @auth()
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Gestiones Extra
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Cambiar Contrasena</a></li>
                  </ul>
                </li>
              @endauth
              
            </ul>
            <ul class="navbar-nav ms-auto bg-accent1 rounded">
              @auth()
                <li class="nav-item">
                  <a class="nav-link" href="{{route('usuarios.logout')}}">cerrar sesion</a>
                </li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>



    @yield('contenido-principal')













    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" 
    crossorigin="anonymous"></script>
  </body>
</html>