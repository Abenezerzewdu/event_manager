<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia; 

class VendorsController extends Controller
{
    /**
     * Display a listing of the vendors.
     */
    public function index()
    {
        $vendors = Vendor::with('user')->latest()->get();

        // Use Inertia to render Vue component
        return Inertia::render('Vendors/Index', [
            'vendors' => $vendors
        ]);
    }

    /**
     * Show the form for creating a new vendor.
     */
    public function create()
    {
        $users = User::all();

        // Use Inertia to render Vue component
        return Inertia::render('Vendors/Create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'user_id' => 'required|exists:users,id',
        ]);

        Vendor::create($request->all());

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor created successfully.');
    }

    /**
     * Display the specified vendor.
     */
    public function show($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id);

        // Use Inertia to render Vue component
        return Inertia::render('Vendors/Show', [
            'vendor' => $vendor
        ]);
    }

    /**
     * Show the form for editing the specified vendor.
     */
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        $users = User::all();

        // Use Inertia to render Vue component
        return Inertia::render('Vendors/Edit', [
            'vendor' => $vendor,
            'users' => $users
        ]);
    }

    /**
     * Update the specified vendor in storage.
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'user_id' => 'required|exists:users,id',
        ]);

        $vendor->update($request->all());

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified vendor from storage.
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor deleted successfully.');
    }
}
