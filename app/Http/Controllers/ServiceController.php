<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::select('id', 'name', 'description', 'price', 'category', 'status', 'created_at')->get();
        return Inertia::render('Service/Index', [
            'services' => $services,
        ]);
    }

    public function create()
    {
        return Inertia::render('Service/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'category' => 'required|in:planned,unplanned',
            'status' => 'required|in:active,inactive',
        ]);

        $service = Service::create($validated);

        return redirect()->back()->with('services', Service::select('id', 'name', 'description', 'price', 'category', 'status', 'created_at')->get())
                               ->with('success', 'Service created successfully!');
    }

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return Inertia::render('Service/Show', [
            'service' => $service,
        ]);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return Inertia::render('Service/Edit', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'category' => 'required|in:planned,unplanned',
            'status' => 'required|in:active,inactive',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->back()->with('services', Service::select('id', 'name', 'description', 'price', 'category', 'status', 'created_at')->get())
                               ->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('services', Service::select('id', 'name', 'description', 'price', 'category', 'status', 'created_at')->get())
                               ->with('success', 'Service deleted successfully!');
    }
}
