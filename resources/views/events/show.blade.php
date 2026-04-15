

@extends('layouts.app')

@section('content')

<h1 class="mb-2">{{ $event->title }}</h1>
<p class="text-muted">{{ $event->venue }} — {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}</p>

<hr>

<p>{{ $event->description }}</p>

<ul class="list-group mb-4">
    <li class="list-group-item"><strong>Precio:</strong> ${{ number_format($event->price, 2) }}</li>
    <li class="list-group-item"><strong>Capacidad total:</strong> {{ $event->capacity }}</li>
    <li class="list-group-item"><strong>Boletos disponibles:</strong> {{ $availableTickets }}</li>
</ul>

@auth
    @if($availableTickets > 0)
        <a href="{{ route('tickets.create', ['event_id' => $event->id]) }}" 
           class="btn btn-success">Comprar Ticket</a>
    @else
        <div class="alert alert-warning">Boletos agotados.</div>
    @endif
@else
    <a href="{{ route('acceso') }}" class="btn btn-primary">Inicia sesión para comprar</a>
@endauth

<a href="{{ route('events.index') }}" class="btn btn-secondary mt-2">Volver a Eventos</a>

@endsection