<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - TicketFast</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1>Bienvenido Organizador</h1>
    <p>¡Crea tu evento o compra al mejor precio en los mejores eventos!</p>

    <hr>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre(s)</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido(s)</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
        <div class="mb-3">
            <label class="form-label">Telefono</label>
            <input type="phone" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">¿Qué te define mejor?</label>
            <select name="tipo" class="form-select" required>
                <option value="">Seleccione una opción</option>
                <option value="organizador">Organizador</option>
                <option value="cliente">Cliente</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Crear contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Crea tu cuenta</button>
    </form>

    <br>
    <a href="{{ route('home') }}">Volver al Home</a>
    
    @endsection

</body>
</html>
