@extends('templates.template')

@section('contenido-principal')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opciones de Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Opciones de Usuario</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Cambiar Contraseña</h5>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('usuario.update-password') }}">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Cambiar Usuario</h5>
                <form>
                    <div class="form-group">
                        <label for="username">Nuevo Usuario</label>
                        <input type="text" class="form-control" id="username" placeholder="Introduce tu nuevo usuario">
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Usuario</button>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Cambiar Fondo</h5>
                <button class="btn btn-secondary" onclick="changeBackground('#f8f9fa')">Fondo Claro</button>
                <button class="btn btn-dark" onclick="changeBackground('#343a40')">Fondo Oscuro</button>
            </div>
        </div>
    </div>

    <script>
        function changeBackground(color) {
            document.body.style.backgroundColor = color;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

@endsection