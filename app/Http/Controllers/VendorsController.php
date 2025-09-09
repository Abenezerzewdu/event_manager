<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class VendorsController extends Controller
{
    /**
     * Display a listing of the vendors.
     */
    public function index()
    {
        $vendors = Vendor::with('user')->latest()->get();

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

        return Inertia::render('Vendors/Create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'company_name'  => 'required|string|max:255',
            'contact_email' => 'required|email',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:255',
            'description'   => 'nullable|string|max:500',
            'plan'          => 'required|in:basic,premium,elite',
            'payment_status'=> 'in:unpaid,paid,refunded',
        ]);

        // status = pending (migration default) but we can enforce explicitly too
        $validated['status'] = 'pending';

        Vendor::create($validated);

        return redirect()->back()->with('success', 'Vendor registration submitted. Awaiting admin approval.');
    }


    /**
     * Display the specified vendor.
     */
    public function show($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id);

        return Inertia::render('Vendors/Show', [
            'vendor' => $vendor
        ]);
    }

    /**
     * Show the form for editing the specified vendor.
     */
    public function edit($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id);
        $users = User::all();

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


       $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'phone' => [ 'required','string','max:20','regex:/^(\+251|0)[0-9]{9}$/'],
            'user_id' => 'required|exists:users,id',
'status' => 'sometimes|required|in:pending,approved,rejected',
            'description' => 'nullable|string',
            'vendors_file' => 'nullable|file|max:10240',],
            [
           'phone.regex' => 'Phone number must start with 0 or +251 and be 10 digits total.',
        ]);

        // Handle file upload
        if ($request->hasFile('vendors_file')) {
            // Delete old file if exists
            if ($vendor->vendors_file) {
                Storage::disk('public')->delete($vendor->vendors_file);
            }
        $validated['vendors_file'] = $request->file('vendors_file')->store('vendors/files', 'public');
        }

        $vendor->update($validated);

        return redirect()->route('vendor.show', $vendor->id)
            ->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified vendor from storage.
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        // Delete associated file
        if ($vendor->vendors_file) {
            Storage::disk('public')->delete($vendor->vendors_file);
        }

        $vendor->delete();

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor deleted successfully.');
    }
}
