<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
    return Inertia::render('Welcome', [
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




Route::prefix('service')->controller(ServiceController::class)->group(function () {
    Route::get('/', 'index')->name('service.index');
    Route::get('/create', 'create')->name('service.create');
    Route::post('/store', 'store')->name('service.store');
    Route::get('/{id}', 'show')->name('service.show');
    Route::get('/{id}/edit', 'edit')->name('service.edit');
    Route::put('/{id}', 'update')->name('service.update');
    Route::delete('/{id}', 'destroy')->name('service.destroy');
});

use App\Http\Controllers\UserController;

Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::get('/create', 'create')->name('user.create');
    Route::post('/store', 'store')->name('user.store');
    Route::get('/{id}', 'show')->name('user.show');
    Route::get('/user/{id}/edit', 'edit')->name('user.edit');
    Route::put('/user/{id}', 'update')->name('user.update');
    Route::delete('/{id}', 'destroy')->name('user.destroy');
});



require __DIR__.'/auth.php';
