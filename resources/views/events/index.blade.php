<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>


    @extends('layouts.app')
    @section('content')

    <h1 class="mb-4">Eventos</h1>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">
                + Nuevo Evento
            </a>
        @endif
    @endauth
    <a href="{{ route('events.api') }}" class="btn btn-success mb-3">
    Ver eventos desde Ticket Tailor
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Precio</th>
                    <th>Disponibles</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $event->venue }}</td>
                        <td>${{ number_format($event->price, 2) }}</td>
                        <td>{{ $event->availableTickets() }} / {{ $event->capacity }}</td>
                        <td class="text-center">
                            <a href="{{ route('events.show', $event->id) }}" 
                            class="btn btn-info btn-sm">Ver</a>

                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('events.edit', $event->id) }}" 
                                    class="btn btn-warning btn-sm">Editar</a>

                                    <form action="{{ route('events.destroy', $event->id) }}" 
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar este evento?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay eventos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary">Volver al Home</a>

    @endsection
    
</body>
</html>