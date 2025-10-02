<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
 
    public function index(){
        $vendors=Vendor::all();
        $totalUsers = User::count();
        $totalVendors = Vendor::count();
        $totalServices = Service::count();

       return Inertia::render('HomeView',[
          'vendors'=>$vendors,
          'totalUsers'=>$totalUsers,
          'totalVendors'=>$totalVendors,
          'totalServices'=>$totalServices,
    ]);

    }

    public function show(){
       return Inertia::render();
    }

    public function edit(){
       return Inertia::render();
    }

    public function update(){
       return Inertia::render();
    }

    public function store(){
       return Inertia::render();
    }


    public function destroy(){
       return Inertia::render();
    }

    public function notify(){
      $vendors=Vendor::where('status','pending')->get();
      // $venor
      return Inertia::render('Admin/Message',[
           'vendors'=>$vendors,
      ]);
   }

   public function approve(vendor $vendor){
     

      $vendor->update(['status' => 'approved']);
      
        $user=User::find($vendor->user_id);
        
        if($user){
            $user->removeRole('organizer');
            $user->assignRole('vendor');
      }
        return back()->with('success', 'Vendor approved successfully!');

   }

   public function reject(vendor $vendor){

        $vendor->delete();
         return back()->with('success', 'Vendor rejected and removed!');


   }
}
