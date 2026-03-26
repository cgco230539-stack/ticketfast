@extends('layouts.app')

@section('content')

<h1>Registrar Administrador</h1>

<form action="{{ route('admin.store') }}" method="POST">
@csrf

<input type="text" name="name" placeholder="Nombre" required>
<br>

<input type="email" name="email" placeholder="Correo" required>
<br>

<input type="text" name="phone" placeholder="Teléfono" required>
<br>

<input type="password" name="password" placeholder="Contraseña" required>
<br>


<button type="submit">Crear Administrador</button>

</form>

@endsection