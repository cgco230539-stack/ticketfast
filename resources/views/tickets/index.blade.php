<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1 class="mb-4">Mis Tickets</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($tickets->isEmpty())
        <div class="alert alert-info">No tienes tickets comprados aún.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td><code>{{ $ticket->unique_code }}</code></td>
                            <td>{{ $ticket->event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($ticket->event->date)->format('d/m/Y H:i') }}</td>
                            <td>{{ $ticket->event->venue }}</td>
                            <td>
                                @if($ticket->status === 'valid')
                                    <span class="badge bg-success">Válido</span>
                                @else
                                    <span class="badge bg-secondary">Usado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('tickets.show', $ticket->id) }}" 
                                class="btn btn-info btn-sm">Ver</a>

                                @if(auth()->user()->is_admin)
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" 
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar este ticket?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('events.index') }}" class="btn btn-primary">Ver Eventos</a>
    <a href="{{ route('home') }}" class="btn btn-secondary">Volver al Home</a>

    @endsection
    

</body>
</html>