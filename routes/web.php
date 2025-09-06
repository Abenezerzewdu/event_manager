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


use App\Http\Controllers\VendorDashboardController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::get('/vendor',function(){

    return Inertia::render('Vendor/index');
});
//debugging 419
// Add this to any controller or create a test route
Route::get('/debug-csrf', function () {
    return response()->json([
        'csrf_token' => csrf_token(),
        'session_token' => session()->token(),
        'session_id' => session()->getId(),
        'session_driver' => config('session.driver'),
    ]);
});
//venue test
Route::get('/venue',function(){
    return Inertia::render('Venue');
});

//dresses test
Route::get('/dresses',function(){
    return Inertia::render('Dresses');
});

//contact test
Route::get('/contact',function(){
    return Inertia::render('Contact');
});

//vendors test
Route::get('/vendors',function(){
    return Inertia::render('Vendors');
});

//admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');


});

//under admin route
Route::prefix('eventtype')->controller(EventTypeController::class)->group(function () {
    Route::get('/', 'index')->name('eventtype.index');
    Route::get('/create', 'create')->name('eventtype.create');
    Route::post('/store', 'store')->name('eventtype.store');
    Route::get('/{id}/edit', 'edit')->name('eventtype.edit');
    Route::get('/{id}', 'show')->name('eventtype.show');
    Route::put('/{id}', 'update')->name('eventtype.update');
    Route::delete('/{id}', 'destroy')->name('eventtype.destroy');

});
Route::get('/', function () {
    return Inertia::render('EventType/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

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

//under organizer role should should be authed
Route::prefix('event')->controller(EventController::class)->group(function () {
    //under admin role since it have got all events view
    Route::get('/', 'index')->name('event.index');
    //both admin and organizer can access this route
    Route::get('/create', 'create')->name('event.create');
    Route::post('/store', 'store')->name('event.store');
//admin can get all event's show but for organizer the user should only see and edit what they creted
    Route::get('/{id}', 'show')->name('event.show');
    Route::get('/{id}/edit', 'edit')->name('event.edit');
    Route::put('/{id}', 'update')->name('event.update');
    Route::delete('/{id}', 'destroy')->name('event.destroy');
});

//under admin role
Route::prefix('vendor')->controller(VendorsController::class)->group(function () {
    //under admin role since it shows all vendors and also lets vendor creation registered
    Route::get('/', 'index')->name('vendor.index');
    Route::get('/create', 'create')->name('vendor.create');
    Route::post('/store', 'store')->name('vendor.store');
    Route::get('/{id}', 'show')->name('vendor.show');
    Route::get('/{id}/edit', 'edit')->name('vendor.edit');
    Route::put('/{id}', 'update')->name('vendor.update');
    Route::delete('/{id}', 'destroy')->name('vendor.destroy');
});


//background route not even needed
// Route::prefix('event-service')->name('event-service.')->group(function () {
//     Route::get('/', [EventServiceController::class, 'index'])->name('index');
//     Route::get('/create', [EventServiceController::class, 'create'])->name('create');
//     Route::post('/', [EventServiceController::class, 'store'])->name('store');
//     Route::get('/{id}', [EventServiceController::class, 'show'])->name('show');
//     Route::get('/{id}/edit', [EventServiceController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [EventServiceController::class, 'update'])->name('update');
//     Route::delete('/{id}', [EventServiceController::class, 'destroy'])->name('destroy');
// });


//
// Route::prefix('vendor-service')->name('vendor-service.')->group(function () {
//     Route::get('/', [\App\Http\Controllers\VendorServiceController::class, 'index'])->name('index');
//     Route::get('/create', [\App\Http\Controllers\VendorServiceController::class, 'create'])->name('create');
//     Route::post('/', [\App\Http\Controllers\VendorServiceController::class, 'store'])->name('store');
//     Route::get('/{vendorService}', [\App\Http\Controllers\VendorServiceController::class, 'show'])->name('show');
//     Route::get('/{vendorService}/edit', [\App\Http\Controllers\VendorServiceController::class, 'edit'])->name('edit');
//     Route::put('/{vendorService}', [\App\Http\Controllers\VendorServiceController::class, 'update'])->name('update');
//     Route::delete('/{vendorService}', [\App\Http\Controllers\VendorServiceController::class, 'destroy'])->name('destroy');
// });
//under organizer and admin role
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



// Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->group(function () {
//     Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
// });


require __DIR__.'/auth.php';
