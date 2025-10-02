<?php

namespace App\Providers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Vendor;
use App\Models\EventType;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Vite;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Vite::prefetch(concurrency: 3);

    Inertia::share([
        'auth' => function () {
            $user = Auth::user();

            return [
                'user' => $user ? [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'email'    => $user->email,
                      
                      'isVendor' => DB::table('vendors')
                        ->where('user_id', $user->id)
                        ->exists(),


                ] : null,
            ];
        },

        //eventtype global props
        'events'=>fn()=>EventType::all(),

        'flash' => function () {
            return [
                'success' => session('success'),
                'error' => session('error'),
            ];
        },
    ]);

   
}}