<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1>REGISTRO</h1>
    <form action="{{ route('registro.store') }}" method="POST">
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

    <input type="text" name="name" placeholder="Nombre" class="form-control" required>
    <br>
    <input type="email" name="email" placeholder="Correo" class="form-control" required>
    <br>
    <input type="text" name="phone" placeholder="Teléfono" class="form-control" required>
    <br>
    <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
    <br>
    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control">
    <br>

    <button type="submit" class="btn btn-success">Guardar</button>
    </form>
    <a href="{{ route('home') }}">Volver al Home</a>
    @endsection

    <div style="text-align: right; margin-bottom:10px;">
    ¿Ya tienes cuenta?
    <a href="{{ route('acceso') }}" class="btn btn-primary btn-sm">Iniciar sesión</a>
    @auth
        @if(auth()->user()->is_admin)
            <h1>Es admin</h1>
        @endif  
    @endauth
    
</div>

</body>
</html>