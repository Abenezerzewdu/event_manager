<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Vendor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        $user = Auth::user();

        $vendor=Vendor::all();


        if($user->vendor){
        return back()->withErrors([
            'vendor' => 'You already registered as a vendor.',
        ]);
        }
        
        
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


    

   public function allVendors(Request $request)
{
    $vendors = Vendor::with(['services', 'reviews']);

    // Filter by category if set
    if ($request->category && $request->category !== 'All Categories') {
        $vendors->whereHas('services', function ($q) use ($request) {
            $q->where('name', $request->category);
        });
    }

    // Search functionality
    if ($request->search) {
        $search = $request->search;
        $vendors->where(function ($q) use ($search) {
            $q->where('company_name', 'like', "%$search%")
              ->orWhere('address', 'like', "%$search%")
              ->orWhereHas('services', function ($sq) use ($search) {
                  $sq->where('name', 'like', "%$search%");
              });
        });
    }

    $vendors = $vendors->paginate(9);

    return Inertia::render('Vendors/Vendors', [
        'vendors' => $vendors->through(fn($vendor) => [
            'id' => $vendor->id,
            'company_name' => $vendor->company_name,
            'description' => $vendor->description,
            'vendors_file' => $vendor->vendors_file,
            'starting_price' => $vendor->services->min('price'),
            'services' => $vendor->services->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'price' => $s->price,
            ]),
            'rating' => round($vendor->reviews->avg('rating'), 1),
            'email' => $vendor->contact_email,
            'phone' => $vendor->phone,
            'address' => $vendor->address,
        ]),
        'categories' => Service::pluck('name'),
        'activeCategory' => $request->category ?? 'All Categories',
    ]);
}

}
