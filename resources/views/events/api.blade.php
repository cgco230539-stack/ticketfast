<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Eventos desde Ticket Tailor</h1>
            <p class="text-muted mb-0">
                Eventos obtenidos desde una API externa integrada en TicketFast.
            </p>
        </div>

        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
            Volver a eventos locales
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @if(empty($events))
        <div class="alert alert-warning shadow-sm">
            No se encontraron eventos en Ticket Tailor.
        </div>
    @else
        <div class="row g-4 justify-content-center">
            @foreach($events as $event)
                @php
                    $eventName = $event['name'] ?? $event['title'] ?? 'Sin título';
                    $eventId = $event['id'] ?? 'N/D';
                    $eventUrl = $event['url'] ?? null;
                    $status = $event['status'] ?? 'Activo';

                    $startRaw = $event['start'] ?? $event['start_at'] ?? null;
                    $endRaw = $event['end'] ?? $event['end_at'] ?? null;

                    $startValue = is_array($startRaw)
                        ? ($startRaw['datetime'] ?? $startRaw['date'] ?? $startRaw['value'] ?? null)
                        : $startRaw;

                    $endValue = is_array($endRaw)
                        ? ($endRaw['datetime'] ?? $endRaw['date'] ?? $endRaw['value'] ?? null)
                        : $endRaw;

                    try {
                        $startFormatted = $startValue
                            ? \Carbon\Carbon::parse($startValue)->format('d/m/Y h:i A')
                            : 'Fecha no disponible';
                    } catch (\Exception $e) {
                        $startFormatted = 'Fecha no disponible';
                    }

                    try {
                        $endFormatted = $endValue
                            ? \Carbon\Carbon::parse($endValue)->format('d/m/Y h:i A')
                            : 'Fecha no disponible';
                    } catch (\Exception $e) {
                        $endFormatted = 'Fecha no disponible';
                    }

                    // 🎨 IMÁGENES DINÁMICAS
                    $image = 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2';

                    if (str_contains(strtolower($eventName), 'indie')) {
                        $image = 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4';
                    } elseif (str_contains(strtolower($eventName), 'electrónico') || str_contains(strtolower($eventName), 'night')) {
                        $image = 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2';
                    } elseif (str_contains(strtolower($eventName), 'expo') || str_contains(strtolower($eventName), 'tecnología')) {
                        $image = 'https://images.unsplash.com/photo-1551836022-d5d88e9218df';
                    }
                @endphp

                <div class="col-md-8 col-lg-5">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">

                            <!-- Imagen -->
                            <img src="{{ $image }}"
                                 class="img-fluid rounded mb-3"
                                 style="height:150px; width:100%; object-fit:cover;">

                            <!-- Badges -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary">API Externa</span>
                                <span class="badge bg-success">{{ $status }}</span>
                            </div>

                            <!-- Título -->
                            <h4 class="fw-bold mb-3">{{ $eventName }}</h4>

                            <!-- Datos -->
                            <div class="mb-2">
                                <small class="text-muted d-block">ID del evento</small>
                                <span>{{ $eventId }}</span>
                            </div>

                            <div class="mb-2">
                                <small class="text-muted d-block">Inicio</small>
                                <span>{{ $startFormatted }}</span>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block">Fin</small>
                                <span>{{ $endFormatted }}</span>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex gap-2 mt-4">
                                @if($eventUrl)
                                    <a href="{{ $eventUrl }}" target="_blank" class="btn btn-primary btn-sm">
                                        Ver evento
                                    </a>
                                @endif

                                <a href="{{ route('events.index') }}" class="btn btn-outline-dark btn-sm">
                                    Ir a mis eventos
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
</body>
</html>