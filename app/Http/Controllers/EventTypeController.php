<?php

namespace App\Http\Controllers;
use App\Models\EventType;
use Illuminate\Http\Request;

use Inertia\Inertia;

class EventTypeController extends Controller
{
    public function index()
    {
        return Inertia::render('EventType/Index',[
        'message' => 'Hello from EventTypeController!',
        'eventTypes' => EventType::all()
    ]);

    }


    public function create(){
        return Inertia::render('EventType/Create', [
            'message' => 'Create a new event type',
        ]);
    }


  public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Planned,Unplanned',
        ]);

        EventType::create($validated);

        return redirect()->route('eventtype.show')
            ->with('success', 'Event type created successfully!');
    }


 public function show($id)
    {
        $eventType = EventType::findOrFail($id); // get the record

        return Inertia::render('EventType/show', [
            'eventType' => $eventType
        ]);
    }
}
