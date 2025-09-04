<?php

namespace App\Http\Controllers;

use App\Models\VendorService;
use App\Models\Vendor;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VendorServiceController extends Controller
{
    public function index()
    {
        $vendorServices = VendorService::with(['vendor', 'service'])->get();
        return Inertia::render('VendorService/Index', [
            'vendorServices' => $vendorServices,
        ]);
    }

    public function create()
    {
        return Inertia::render('VendorService/Create', [
            'vendors' => Vendor::select('id', 'company_name')->get(),
            'services' => Service::select('id', 'name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Check for unique vendor-service pair
        if (VendorService::where('vendor_id', $validated['vendor_id'])->where('service_id', $validated['service_id'])->exists()) {
            return back()->withErrors(['vendor_service' => 'This vendor-service combination already exists.']);
        }

        VendorService::create($validated);

        return redirect()->route('vendor-service.index')->with('success', 'Vendor Service created successfully.');
    }

    public function show(VendorService $vendorService)
    {
        $vendorService->load(['vendor', 'service']);
        return Inertia::render('VendorService/Show', [
            'vendorService' => $vendorService,
        ]);
    }

    public function edit(VendorService $vendorService)
    {
        $vendorService->load(['vendor', 'service']);
        return Inertia::render('VendorService/Edit', [
            'vendorService' => $vendorService,
            'vendors' => Vendor::select('id', 'company_name')->get(),
            'services' => Service::select('id', 'name')->get(),
        ]);
    }

    public function update(Request $request, VendorService $vendorService)
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'service_id' => 'required|exists:services,id',
        ]);

        // Check for unique vendor-service pair, excluding the current record
        if (
            VendorService::where('vendor_id', $validated['vendor_id'])
                ->where('service_id', $validated['service_id'])
                ->where('id', '!=', $vendorService->id)
                ->exists()
        ) {
            return back()->withErrors(['vendor_service' => 'This vendor-service combination already exists.']);
        }

        $vendorService->update($validated);

        return redirect()->route('vendor-service.show', $vendorService->id)->with('success', 'Vendor Service updated successfully.');
    }

    public function destroy(VendorService $vendorService)
    {
        $vendorService->delete();
        return redirect()->route('vendor-service.index')->with('success', 'Vendor Service deleted successfully.');
    }
}

