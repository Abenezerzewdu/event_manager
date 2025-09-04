<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\EventServiceController;

use
App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/vendor',function(){
    return Inertia::render('Vendor/index');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::prefix('eventtype')->controller(EventTypeController::class)->group(function () {
    Route::get('/', 'index')->name('eventtype.index');
    Route::get('/create', 'create')->name('eventtype.create');
    Route::post('/store', 'store')->name('eventtype.store');
    Route::get('/{id}/edit', 'edit')->name('eventtype.edit');
    Route::get('/{id}', 'show')->name('eventtype.show');
    Route::put('/{id}', 'update')->name('eventtype.update');
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




Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('service.create');
Route::post('/services', [ServiceController::class, 'store'])->name('service.store');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service.show');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');


Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::get('/create', 'create')->name('user.create');
    Route::post('/store', 'store')->name('user.store');
    Route::get('/{id}/edit', 'edit')->name('user.edit');
    Route::get('/{id}', 'show')->name('user.show');
    Route::put('/{id}', 'update')->name('user.update');
    Route::delete('/{id}', 'destroy')->name('user.destroy');
});

Route::prefix('event')->controller(EventController::class)->group(function () {
    Route::get('/', 'index')->name('event.index');
    Route::get('/create', 'create')->name('event.create');
    Route::post('/store', 'store')->name('event.store');
    Route::get('/{id}', 'show')->name('event.show');
    Route::get('/{id}/edit', 'edit')->name('event.edit');
    Route::put('/{id}', 'update')->name('event.update');
    Route::delete('/{id}', 'destroy')->name('event.destroy');
});


Route::prefix('vendor')->controller(VendorsController::class)->group(function () {
    Route::get('/', 'index')->name('vendor.index');
    Route::get('/create', 'create')->name('vendor.create');
    Route::post('/store', 'store')->name('vendor.store');
    Route::get('/{id}', 'show')->name('vendor.show');
    Route::get('/{id}/edit', 'edit')->name('vendor.edit');
    Route::put('/{id}', 'update')->name('vendor.update');
    Route::delete('/{id}', 'destroy')->name('vendor.destroy');
});



Route::prefix('event-service')->name('event-service.')->group(function () {
    Route::get('/', [EventServiceController::class, 'index'])->name('index');
    Route::get('/create', [EventServiceController::class, 'create'])->name('create');
    Route::post('/', [EventServiceController::class, 'store'])->name('store');
    Route::get('/{id}', [EventServiceController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [EventServiceController::class, 'edit'])->name('edit');
    Route::put('/{id}', [EventServiceController::class, 'update'])->name('update');
    Route::delete('/{id}', [EventServiceController::class, 'destroy'])->name('destroy');
});



Route::prefix('vendor-service')->name('vendor-service.')->group(function () {
    Route::get('/', [\App\Http\Controllers\VendorServiceController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\VendorServiceController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\VendorServiceController::class, 'store'])->name('store');
    Route::get('/{vendorService}', [\App\Http\Controllers\VendorServiceController::class, 'show'])->name('show');
    Route::get('/{vendorService}/edit', [\App\Http\Controllers\VendorServiceController::class, 'edit'])->name('edit');
    Route::put('/{vendorService}', [\App\Http\Controllers\VendorServiceController::class, 'update'])->name('update');
    Route::delete('/{vendorService}', [\App\Http\Controllers\VendorServiceController::class, 'destroy'])->name('destroy');
});

Route::prefix('guest')->name('guest.')->controller(GuestController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{guest}', 'show')->name('show');
    Route::get('/{guest}/edit', 'edit')->name('edit');
    Route::put('/{guest}', 'update')->name('update');
    Route::delete('/{guest}', 'destroy')->name('destroy');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('review.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('review.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');


require __DIR__.'/auth.php';
