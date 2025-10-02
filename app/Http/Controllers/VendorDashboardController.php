<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VendorDashboardController extends Controller
{
   public function index()
    {
        $vendorId = Auth::user()->vendor?->id;    
      
        // Fallback if user is not a vendor
        if (!$vendorId) {
            return Inertia::render('Vendors/Dashboard', [
                'stats' => [
                    'users' => 0,
                    'orders' => 0,
                    'services' => 0,
                ]
            ]);
        }

        // Number of users who placed orders with this vendor
        $userCount = Order::where('vendor_id', $vendorId)
                          ->distinct('user_id')
                          ->count('user_id');

        // Number of orders received by this vendor
        $orderCount = Order::where('vendor_id', $vendorId)->count();

        // Number of services the vendor provides
        $serviceCount = DB::table('vendor_services')
                          ->where('vendor_id', $vendorId)
                          ->count();

        return Inertia::render('Vendors/Dashboard', [
            'stats' => [
                'users' => $userCount,
                'orders' => $orderCount,
                'services' => $serviceCount,
            ]
        ]);
    }

    public function ViewServices(){
    
        $services=Service::all();
        return Inertia::render('Vendors/ViewServices',[
        
            'services' => $services,
        ]);
    }

    public function profile(){
    
           $vendor = auth()->user()->vendor;  

        return Inertia::render('Vendors/Profile',[
              'vendor' => $vendor,
        ])->with('success', 'Profile updated successfully!');;

    }


    public function updateServices(Request $request)
{
    $validated = $request->validate([
        'services' => 'array',
        'services.*' => 'exists:services,id'
    ]);

    $vendor = auth()->user()->vendor; // assuming logged-in user has a vendor profile

    $vendor->services()->sync($validated['services'] ?? []);

    return redirect()
        ->back()
        ->with('success', 'Services updated successfully!');
}

public function updateProfile(Request $request)
{
    $vendor = auth()->user()->vendor;

    $validated = $request->validate([
        'company_name'   => 'required|string|max:255',
        'contact_email'  => 'required|email|max:255',
        'phone'          => 'required|string|max:20',
        'address'        => 'required|string|max:255',
        'description'    => 'nullable|string|max:1000',
        'vendors_file'   => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
    ]);

    // Handle file upload if exists
    if ($request->hasFile('vendors_file')) {
        $path = $request->file('vendors_file')->store('vendor_files', 'public');
        $validated['vendors_file'] = $path;
    }

    $vendor->update($validated);

    return redirect()
        ->back()
        ->with('success', 'Profile updated successfully!');
}


}
