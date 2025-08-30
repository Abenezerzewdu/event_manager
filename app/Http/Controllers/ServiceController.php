<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('service/Index', [
            'message' => 'Hello from ServiceController!',
            'services' => Service::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('service/Create', [
            'message' => 'Create a new service',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:planned,unplanned',
        ]);

        $service = Service::create($validated);

        return redirect()->route('service.show', $service->id)
                         ->with('success', 'Service created successfully!');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);

        return Inertia::render('service/Show', [
            'service' => $service
        ]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return Inertia::render('service/Edit', [
            'service' => $service,
            'message' => 'Edit Service'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|in:planned,unplanned',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->route('service.index', $service->id)
                         ->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')
                         ->with('success', 'Service deleted successfully!');
    }
}
