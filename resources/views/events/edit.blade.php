@extends('layouts.app')

@section('content')

<h1 class="mb-4">Editar Evento</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha y Hora</label>
        <input type="datetime-local" name="date" class="form-control" 
               value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i')) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Lugar</label>
        <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Precio ($)</label>
        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $event->price) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Capacidad</label>
        <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $event->capacity) }}">
    </div>

    <button type="submit" class="btn btn-warning">Actualizar Evento</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

@endsection