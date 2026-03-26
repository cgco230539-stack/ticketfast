<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TicketFast</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1>Bienvenido a TicketFast</h1>
    <p>Sistema de gestión de tickets</p>

    <hr>

    <nav>
        <ul>
            
            <li><a href="{{ route('registro') }}">Crear cuenta</a></li>
            <li><a href="{{ route('users.index') }}">Ver Usuario Registrados</a></li>
            @auth
                @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.create') }}">Registrar a un administrador</a></li>
                    <li><a href="{{ route('admins.index') }}">Lista admins</a></li>
                    <li><a href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                @endif  
            @endauth
        </ul>
    </nav>
    @auth
    <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
    </form>
    @endauth
@endsection


</body>
</html>
