<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission;
use Spatie\Permission\Traits\HasRoles;
class DashboardRedirectController extends Controller
{
    public function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('vendor')) {
            return redirect()->route('vendor.dashboard');
        }

        if ($user->hasRole('organizer')) {
            return redirect()->route('organizer.dashboard');
        }

        
        return redirect()->route('home');
    }
}
