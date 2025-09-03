<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    public function index()
    {
        $guests = Guest::with('event')->latest()->get();
        return Inertia::render('Guest/Index', [
            'guests' => $guests,
             'events' => Event::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Guest/Create', [
            'events' => Event::select('id', 'title')->get(),
        ]);
    }

   public function store(Request $request)
{
    try {
        Log::info('Store request received', ['data' => $request->all()]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|ends_with:@gmail.com', // Match Vue validation
            'phone' => ['required', 'string', 'regex:/^(09[0-9]{8}$|\+251[0-9]{9}$)/'], // Match Vue validation
            'event_id' => 'required|exists:events,id',
            'is_attending' => 'boolean',
        ]);

        $guest = Guest::create($validated);
        Log::info('Guest created successfully', ['guest_id' => $guest->id, 'guest' => $guest->toArray()]);

        return redirect()->route('guest.index')->with('success', 'Guest created successfully.');
    } catch (\Exception $e) {
        Log::error('Failed to create guest', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'data' => $request->all(),
        ]);
        return redirect()->back()->withErrors(['error' => 'Failed to create guest: ' . $e->getMessage()]);
    }
}

    public function show(Guest $guest)
    {
        $guest->load('event');
        return Inertia::render('Guest/Show', [
            'guest' => $guest,
        ]);
    }

    public function edit(Guest $guest)
    {
        $guest->load('event');
        return Inertia::render('Guest/Edit', [
            'guest' => $guest,
            'events' => Event::select('id', 'title')->get(),
        ]);
    }

    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'regex:/^(0[0-9]{9}$|\+251[0-9]{9}$)/'],
            'email' => ['nullable', 'email', 'regex:/^[a-zA-Z0-9]+@gmail\.com$/i'],
            'event_id' => 'required|exists:events,id',
            'is_attending' => 'boolean',
        ]);

        $guest->update($validated);

        return redirect()->route('guest.show', $guest->id)->with('success', 'Guest updated successfully.');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guest.index')->with('success', 'Guest deleted successfully.');
    }
}
