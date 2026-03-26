<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <h1>ACCESO</h1>

    <form action="{{ route('acceso.store') }}" method="POST">
        @csrf
        @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
         @endif

        <input type="email" name="email" placeholder="Correo" class="form-control" required>
        <br>
        <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
        <br>

        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
    <a href="{{ route('home') }}">Volver al Home</a>
    <a href="{{ route('registro') }}">Crear cuenta</a>
    @endsection
    

</body>
</html>