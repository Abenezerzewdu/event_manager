<?php

namespace App\Http\Controllers;
use App\Models\EventType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
            'category' => 'required|string|in:planned,unplanned',
        ]);

    $eventType = EventType::create($request->only('name'));
            
    
            return Inertia::location(route('eventtype.index'));

}

public function show($id)
    {
        $eventType = EventType::findOrFail($id); // get the record

        return Inertia::render('EventType/Show', [
            'eventType' => $eventType
        ]);
    }


public function edit($id)
{
    $eventType = EventType::findOrFail($id);

    return Inertia::render('EventType/Edit', [
        'eventType' => $eventType,
        'message' => 'Edit Event Type'
    ]);
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|in:planned,unplanned',
    ]);

    $eventType = EventType::findOrFail($id);
    $eventType->update($request->only('name', 'category'));

    return Inertia::location(route('eventtype.index'));

}

public function destroy($id)
{
    $eventType = EventType::findOrFail($id);
    $eventType->delete();

    return  Inertia::location(route('eventtype.index'));
;
}
}
