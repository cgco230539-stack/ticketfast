<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
    @extends('layouts.app')
    @section('content')

    <h1 class="mb-4">Detalle del Ticket</h1>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>Código:</strong> <code class="text-white">{{ $ticket->unique_code }}</code>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $ticket->event->title }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Fecha:</strong> 
                    {{ \Carbon\Carbon::parse($ticket->event->date)->format('d/m/Y H:i') }}
                </li>
                <li class="list-group-item">
                    <strong>Lugar:</strong> {{ $ticket->event->venue }}
                </li>
                <li class="list-group-item">
                    <strong>Precio:</strong> ${{ number_format($ticket->event->price, 2) }}
                </li>
                <li class="list-group-item">
                    <strong>Estado:</strong>
                    @if($ticket->status === 'valid')
                        <span class="badge bg-success">Válido</span>
                    @else
                        <span class="badge bg-secondary">Usado</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Mis Tickets</a>
        <a href="{{ route('events.index') }}" class="btn btn-primary">Ver Eventos</a>
    </div>

    @endsection

</body>
</html>