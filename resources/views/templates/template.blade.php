<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto tsi</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/agenda.js')}}" defer></script>
    <link href="{{asset('css/bootstrap-custom2.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* AliceBlue */
        }
        .navbar {
            background-color: #ff6347; /* Tomato */
        }
        .navbar-brand, .nav-link, .navbar-toggler-icon {
            color: #fff !important;
        }
        .navbar-nav .nav-item .nav-link {
            color: #fff !important;
        }
        .navbar-nav .nav-item .dropdown-menu {
            background-color: #ff6347; /* Tomato */
        }
        .navbar-nav .nav-item .dropdown-item {
            color: #fff !important;
        }
        .navbar-nav .nav-item .dropdown-item:hover {
            background-color: #ff4500; /* OrangeRed */
        }
        .bg-accent1 {
            background-color: #4682b4; /* SteelBlue */
        }
        .active {
            text-shadow: 0 0 10px #fff; /* Efecto de brillo */
        }
    </style>
</head>
<body>
    <nav class="navbar p-0 navbar-expand-lg">
        <div class="container-fluid">
            @auth
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <i class="material-icons">account_circle</i>
                    <span>{{ Auth::user()->nombre_usuario }}</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{route('home.index')}}">
                            <i class="fa-solid fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('opciones') ? 'active' : '' }}" href="{{route('home.opciones')}}">
                            <i class="fa-solid fa-gear"></i> Ajustes
                        </a>
                    </li>
                </ul>
            @endauth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usuarios.logout') }}">
                                <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('contenido-principal')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>