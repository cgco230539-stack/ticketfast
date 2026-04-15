<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\TicketTailorService;

class EventController extends Controller
{
    // Listar todos los eventos
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }
    // Formulario para crear evento
    public function create()
    {
        return view('events.create');
    }
    // Guardar nuevo evento
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'venue'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
        ], [
            'title.required'       => 'El título es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'date.required'        => 'La fecha es obligatoria.',
            'venue.required'       => 'El lugar es obligatorio.',
            'price.required'       => 'El precio es obligatorio.',
            'capacity.required'    => 'La capacidad es obligatoria.',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Evento creado exitosamente.');
    }

    // Mostrar detalle de un evento
    public function show(Event $event)
    {
        $availableTickets = $event->availableTickets();
        return view('events.show', compact('event', 'availableTickets'));
    }

    // Formulario para editar evento
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Actualizar evento
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'venue'       => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Evento actualizado exitosamente.');
    }

    // Eliminar evento (solo admin)
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }

    // Sincronizar eventos desde Ticket Tailor
    public function apiEvents(TicketTailorService $service){
        try {
            $response = $service->getEvents();

            $events = $response['data'] ?? [];

            return view('events.api', compact('events'));

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}