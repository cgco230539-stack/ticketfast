<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    @extends('layouts.app')
    @section('content')

    <h1 class="mb-4">Comprar Ticket</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->description }}</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Fecha:</strong> 
                    {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}
                </li>
                <li class="list-group-item">
                    <strong>Lugar:</strong> {{ $event->venue }}
                </li>
                <li class="list-group-item">
                    <strong>Precio:</strong> ${{ number_format($event->price, 2) }}
                </li>
                <li class="list-group-item">
                    <strong>Boletos disponibles:</strong> {{ $event->availableTickets() }}
                </li>
            </ul>
        </div>
    </div>

    @if($event->availableTickets() > 0)
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <button type="submit" class="btn btn-success">
                Confirmar Compra
            </button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    @else
        <div class="alert alert-warning">Boletos agotados para este evento.</div>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Volver a Eventos</a>
    @endif

    @endsection


</body>
</html>