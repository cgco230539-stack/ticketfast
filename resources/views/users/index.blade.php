<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1 class="mb-4">Usuarios Registrados</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-blue">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td class="text-center">

                            <a href="{{ route('users.edit', $user->id) }}" 
                            class="btn btn-warning btn-sm">
                            Editar
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" 
                                method="POST" 
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary">
        Volver al Home
    </a>
    @auth
        <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
    @endauth
    @endsection

</body>
</html>
