<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    // Listar tickets del usuario actual
    public function index()
    {
        $tickets = Ticket::with('event')
            ->where('user_id', auth()->id())
            ->get();
        return view('tickets.index', compact('tickets'));
    }

    // Formulario para comprar ticket
    public function create(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        return view('tickets.create', compact('event'));
    }
    // Guardar ticket (comprar)
    public function store(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        // Verificar disponibilidad
        if ($event->availableTickets() <= 0) {
            return back()->with('error', 'Lo sentimos, boletos agotados para este evento.');
        }
        Ticket::create([
            'user_id'     => auth()->id(),
            'event_id'    => $event->id,
            'unique_code' => strtoupper(Str::random(10)),
            'status'      => 'valid',
        ]);
        return redirect()->route('tickets.index')
            ->with('success', '¡Ticket comprado exitosamente!');
    }

    // Ver detalle de un ticket
    public function show(Ticket $ticket)
    {
        // Solo el dueño o admin puede ver el ticket
        if (auth()->id() !== $ticket->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        return view('tickets.show', compact('ticket'));
    }

    // Solo admin puede eliminar tickets
    public function destroy(Ticket $ticket)
    {
        if (!auth()->user()->is_admin) {
            return back()->with('error', 'No tienes permiso para eliminar tickets.');
        }

        $ticket->delete();
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket eliminado correctamente.');
    }

    // Admin ve todos los tickets
    public function adminIndex()
    {
        $tickets = Ticket::with(['event', 'user'])->get();
        return view('tickets.admin', compact('tickets'));
    }

    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
}