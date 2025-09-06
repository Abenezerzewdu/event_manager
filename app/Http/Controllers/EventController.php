<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['user', 'eventType'])->get();

        return Inertia::render('Event/Index', [
            'events' => $events->toArray(),
            'eventTypes' => EventType::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Event/Create', [
            'users' => User::all(),
            'eventTypes' => EventType::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date|after_or_equal:today',
            'location' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0', 
            'event_type_id' => 'required|integer|exists:event_types,id',
            'status' => 'required|string',
        ]);

        
        // Attach logged in user
    $validated['user_id'] = Auth::id();
    
        $event = Event::create($validated);

        return redirect()->route('event.show', $event->id)
                         ->with('success', 'Event created successfully!');
    }

    public function show($id)
    {
        $event = Event::with(['user', 'eventType', 'guests', 'eventServices'])->findOrFail($id);

        return Inertia::render('Event/Show', [
            'event' => $event,
        ]);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return Inertia::render('Event/Edit', [
            'event' => $event,
            'users' => User::all(),
            'eventTypes' => EventType::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
            'user_id' => 'required|integer|exists:users,id',
            'event_type_id' => 'required|integer|exists:event_types,id',
            'is_planned' => 'required|boolean',
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
