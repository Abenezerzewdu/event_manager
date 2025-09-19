<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Models\EventType;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
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
            return [
                'user' => Auth::user(),
                
            ];

        },
        //eventtype global props
        'events'=>fn()=>EventType::all(),
    ]);

   
}}