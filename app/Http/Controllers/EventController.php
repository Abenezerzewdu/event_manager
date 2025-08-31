<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['user', 'eventType'])->get();

        return Inertia::render('Event/Index', [
            'events' => $events,
            'message' => 'Events list'
        ]);
    }

    public function create()
    {
        return Inertia::render('Event/Create', [
            'users' => User::all(),
            'eventTypes' => EventType::all(),
            'message' => 'Create New Event'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'is_planned' => 'boolean',
            'event_type_id' => 'required|exists:event_types,id',
            'event_date' => 'required|date|after_or_equal:today',

        ]);

        $event = Event::create($validated);

        return redirect()->route('event.show', $event->id)
                         ->with('success', 'Event created successfully!');
    }

    public function show($id)
    {
        $event = Event::with(['user', 'eventType', 'guests', 'eventServices'])->findOrFail($id);

        return Inertia::render('Event/Show', [
            'event' => $event
        ]);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return Inertia::render('Event/Edit', [
            'event' => $event,
            'users' => User::all(),
            'eventTypes' => EventType::all(),
            'message' => 'Edit Event'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'event_type_id' => 'required|exists:event_types,id'
        ]);

        $event = Event::findOrFail($id);
        $event->update($validated);

        return redirect()->route('event.show', $event->id)
                         ->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('event.index')
                         ->with('success', 'Event deleted successfully!');
    }
}
