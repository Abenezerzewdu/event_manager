<?php

namespace App\Http\Controllers;

use id;
use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;

class OrganizerDashboardController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();

    $events = $user->events()->count(); // only events created by this user
    $orders = $user->orders()->count(); // only orders created by this user
    $vendors = $user->orders()->distinct('vendor_id')->count('vendor_id'); // vendors user ordered from

    return Inertia::render('Organizer/Dashboard', [
        'stats' => [
            'events' => $events,
            'orders' => $orders,
            'vendors' => $vendors,
        ],
    ]);
}

//main events showing page for the dashboard

public function index()
{
    $events = Event::where('user_id', auth()->id())->get();

    return Inertia::render('Organizer/Events/Index', [
        'events' => $events,
    ]);
}

// to show particular events for the organizer inside dashboard
public function show($id)
{
    $event = auth()->user()->events()
                ->with(['eventType'])
                ->findOrFail($id);

    return Inertia::render('Organizer/Events/Show', [
        'event' => $event,
    ]);
}

public function edit($id)
{
    $event = Event::where('id', $id)
                  ->where('user_id', auth()->id()) // ensure owner
                  ->firstOrFail();

    return Inertia::render('Organizer/Events/Edit', [
        'event' => $event
    ]);
}

public function update(Request $request, $id)
{
    $event = Event::where('id', $id)
                  ->where('user_id', auth()->id()) // ensure owner
                  ->firstOrFail();

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'event_date' => 'required|date',
        'location' => 'required|string|max:255',
        'budget' => 'required|numeric|min:0',
        'event_type_id' => 'required|exists:event_types,id',
    ]);

    $event->update($validated);

    return redirect()->route('organizer.events.index')
                     ->with('success', 'Event updated successfully!');
}

public function destroy($id)
{
    $event = Event::where('id', $id)
                  ->where('user_id', auth()->id()) // ensure owner
                  ->firstOrFail();

    $event->delete();

    return redirect()->route('organizer.events.index')
                     ->with('success', 'Event deleted successfully!');
}


}
