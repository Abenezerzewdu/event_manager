<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Service;
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
}
