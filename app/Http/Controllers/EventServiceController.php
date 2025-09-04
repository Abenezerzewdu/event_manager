<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use App\Models\Vendor;
use App\Models\Service;
use App\Models\EventService;
use Illuminate\Http\Request;

class EventServiceController extends Controller
{
    // List all EventServices
    public function index()
    {
        $eventServices = EventService::with(['event', 'service', 'vendor'])->get();

        return Inertia::render('EventService/Index', [
            'eventServices' => $eventServices,
        ]);
    }

    // Show create form
    public function create()
    {
        $events = Event::select('id', 'title')->get();
        $services = Service::select('id', 'name')->get();
        $vendors = Vendor::select('id', 'company_name')->get();

        return Inertia::render('EventService/Create', [
            'events' => $events,
            'services' => $services,
            'vendors' => $vendors,
        ]);
    }

    // Store new EventService
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'service_id' => 'required|exists:services,id',
            'vendor_id' => 'required|exists:vendors,id',
            'status' => 'required|in:pending,confirmed,done',
            'notes' => 'nullable|string',
        ]);

        EventService::create($validated);

        return redirect()->route('event-service.index')->with('success', 'Event Service created successfully.');
    }

    // Show a single EventService
    public function show(EventService $eventService)
    {
        $eventService->load(['event', 'service', 'vendor']);

        return Inertia::render('EventService/Show', [
            'eventService' => $eventService,
        ]);
    }

    // Show edit form
    public function edit(EventService $eventService)
    {
        $eventService->load(['event', 'service', 'vendor']);

        $events = Event::select('id', 'title')->get();
        $services = Service::select('id', 'name')->get();
        $vendors = Vendor::select('id', 'company_name')->get();

        return Inertia::render('EventService/Edit', [
            'eventService' => $eventService,
            'events' => $events,
            'services' => $services,
            'vendors' => $vendors,
        ]);
    }

    // Update EventService
    public function update(Request $request, EventService $eventService)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'service_id' => 'required|exists:services,id',
            'vendor_id' => 'required|exists:vendors,id',
            'status' => 'required|in:pending,confirmed,done',
            'notes' => 'nullable|string',
        ]);

        $eventService->update($validated);

        return redirect()->route('event-service.show', $eventService->id)->with('success', 'Event Service updated successfully.');
    }

    // Delete EventService
    public function destroy(EventService $eventService)
    {
        $eventService->delete();

        return redirect()->route('event-service.index')->with('success', 'Event Service deleted successfully.');
    }
}
