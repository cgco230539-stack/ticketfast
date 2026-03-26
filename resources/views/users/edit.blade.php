<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')

<h1>Editar Usuario</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" 
                name="name" 
                value="{{ $user->name }}" 
                class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" 
                name="email" 
                value="{{ $user->email }}" 
                class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Telefono</label>
            <input type="phone" 
                name="phone" 
                value="{{ $user->phone }}" 
                class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
    </form>

<br>
<a href="{{ route('users.index') }}">Volver</a>
  
@endsection

</body>
</html>
