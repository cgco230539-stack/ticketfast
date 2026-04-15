<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    @extends('layouts.app')
    @section('content')

    <h1 class="mb-4">Crear Evento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ old('date') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Lugar</label>
            <input type="text" name="venue" class="form-control" value="{{ old('venue') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio ($)</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Capacidad</label>
            <input type="number" name="capacity" class="form-control" value="{{ old('capacity') }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Evento</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    @endsection
</body>
</html>