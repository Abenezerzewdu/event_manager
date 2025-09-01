<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorsController extends Controller
{
    /**
     * Display a listing of the vendors.
     */
    public function index()
    {
        $vendors = Vendor::with('user')->latest()->get();
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     */
    public function create()
    {
        $users = User::all();
        return view('vendors.create', compact('users'));
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Vendor::create($validator->validated());

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor created successfully.');
    }

    /**
     * Display the specified vendor.
     */
    public function show($id)
    {
        $vendor = Vendor::with(['user', 'vendorServices', 'reviews'])->findOrFail($id);
        return view('vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified vendor.
     */
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        $users = User::all();
        return view('vendors.edit', compact('vendor', 'users'));
    }

    /**
     * Update the specified vendor in storage.
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'company_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendor->update($validator->validated());

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
