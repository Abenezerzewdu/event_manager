<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/vendor',function(){ 
    return Inertia::render('Vendor/index');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::prefix('eventtype')->controller(EventTypeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create')->name('eventtype.create');
    Route::post('/store', 'store')->name('eventtype.store');
    Route::get('/{id}', 'show')->name('eventtype.show');
    Route::get('/eventtype/{id}/edit', [EventTypeController::class, 'edit'])->name('eventtype.edit');
    Route::put('/eventtype/{id}', [EventTypeController::class, 'update'])->name('eventtype.update');
    Route::delete('/{id}', 'destroy')->name('eventtype.destroy');

});

});

Route::get('/', function () {
    return Inertia::render('EventType/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/home',function(){
    return Inertia::render('EventType/AppHeader');
});

Route::prefix('service')->controller(ServiceController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create')->name('service.create');
    Route::post('/store', 'store')->name('service.store');
    Route::get('/{id}', 'show')->name('service.show');
    Route::get('/service/{id}/edit', 'edit')->name('service.edit');
    Route::put('/service/{id}', 'update')->name('service.update');
    Route::delete('/{id}', 'destroy')->name('service.destroy');
});



require __DIR__.'/auth.php';
