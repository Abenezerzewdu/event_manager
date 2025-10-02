<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;

use App\Http\Controllers\GuestController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;



use App\Http\Controllers\VendorsController;


use App\Http\Controllers\EventTypeController;

use App\Http\Controllers\EventServiceController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\OrganizerDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;

//organizer dashboard





//via spatie,routes under organizer and admin role
Route::middleware(['auth','role:organizer|admin'])->group(function () {

    Route::get('/organizer/dashboard',[OrganizerDashboardController::class,'dashboard'])->name('organizer.dashboard');

     Route::get('/organizer/events', [OrganizerDashboardController::class, 'index'])->name('organizer.events.index');

    Route::get('/organizer/events/{id}', [OrganizerDashboardController::class, 'show'])->name('organizer.events.show');

    Route::get('/organizer/events/{id}/edit', [OrganizerDashboardController::class, 'edit'])->name('organizer.events.edit');

    // Update Event
Route::put('/organizer/events/{id}', [OrganizerDashboardController::class, 'update'])
    ->name('organizer.events.update');

// Delete Event
Route::delete('/organizer/events/{id}', [OrganizerDashboardController::class, 'destroy'])
    ->name('organizer.events.destroy');


      //event creating inside organizer
Route::prefix('event')->controller(EventController::class)->group(function () {
    Route::get('/create', 'create')->name('event.create');
    
     Route::post('/store', 'store')->name('event.store');
});

Route::prefix('vendor')->controller(VendorsController::class)->group(function () {
    Route::post('/store','store')->name('vendor.store');
});

 Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
 
 Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

 Route::get('/orders/choose-event', [OrderController::class, 'chooseEvent'])
    ->name('orders.choose-event');

Route::post('/orders/handle', [OrderController::class, 'handleOrder'])
    ->name('orders.handle');

  Route::post('event/store', [EventController::class,'store'])->name('event.store');

});



//via spatie,routes under vendor role

Route::middleware(['auth','role:vendor'])->group(function () {
  
    Route::get('/vendor/dashboard',[VendorDashboardController::class,'index'])->name('vendor.dashboard');

    Route::get('/vendor/services',[VendorDashboardController::class,'ViewServices'])->name('vendor.services');

    Route::post('/vendor/services/update', [VendorDashboardController::class, 'updateServices'])
    ->name('vendor.services.update');

    Route::get('/vendor/profile',[VendorDashboardController::class,'profile'])->name('vendor.profile');

    Route::post('/vendor/profile/update', [VendorDashboardController::class, 'updateProfile'])
    ->name('vendor.profile.update');

    Route::get('/vendor/orders', [OrderController::class, 'vendorOrders'])->name('vendor.orders');

    Route::put('/vendor/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('vendor.orders.updateStatus');

});

//via spatie,routes under admin role

Route::middleware(['auth','role:admin'])->group(function () {
      //admin dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
         // notifications 
    Route::get('/admin/messages', [AdminController::class, 'notify'])->name('admin.messages');

         //vendor approve,reject from notification
    Route::post('/vendors/{vendor}/approve', [AdminController::class, 'approve'])
    ->name('vendors.approve');
         
   Route::post('/vendors/{vendor}/reject', [AdminController::class, 'reject'])
    ->name('vendors.reject');

    //admin dashboard pages under admin 
Route::get('/tables', function () {
  return Inertia::render('TablesView');
})->middleware(['auth', 'verified'])->name('tables');

Route::get('/forms', function () {
  return Inertia::render('FormsView');
})->middleware(['auth', 'verified'])->name('forms');

Route::get('/Error', function () {
  return Inertia::render('ErrorView');
})->middleware(['auth', 'verified'])->name('error');

Route::get('/profiles', function () {
  return Inertia::render('ProfileView');
})->middleware(['auth', 'verified'])->name('profiles');

Route::get('/responsive', function () {
  return Inertia::render('ResponsiveView');
})->middleware(['auth', 'verified'])->name('responsive');

Route::get('/style', function () {
  return Inertia::render('StyleView');
})->middleware(['auth', 'verified'])->name('style');

Route::get('/ui', function () {
  return Inertia::render('UiView');
})->middleware(['auth', 'verified'])->name('ui');

//event type under admin route
Route::prefix('eventtype')->controller(EventTypeController::class)->group(function () {
    Route::get('/', 'index')->name('eventtype.index');
    Route::get('/create', 'create')->name('eventtype.create');
    Route::post('/store', 'store')->name('eventtype.store');
    Route::get('/{id}/edit', 'edit')->name('eventtype.edit');
    Route::get('/{id}', 'show')->name('eventtype.show');
    Route::put('/{id}', 'update')->name('eventtype.update');
    Route::delete('/{id}', 'destroy')->name('eventtype.destroy');

});

//user managment under admin route
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('user.index');
    Route::get('/create', 'create')->name('user.create');
    Route::post('/store', 'store')->name('user.store');
    Route::get('/{id}/edit', 'edit')->name('user.edit');
    Route::get('/{id}', 'show')->name('user.show');
    Route::put('/{id}', 'update')->name('user.update');
    Route::delete('/{id}', 'destroy')->name('user.destroy');
});

//service managment under admin route
Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('service.create');
Route::post('/services', [ServiceController::class, 'store'])->name('service.store');
 Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service.show');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
//under admin role vendor managment

Route::prefix('vendor')->controller(VendorsController::class)->group(function () {
    //under admin role since it shows all vendors and also lets vendor creation registered
    Route::get('/', 'index')->name('vendor.index');
    Route::get('/create', 'create')->name('vendor.create');
    // Route::post('/store', 'store')->name('vendor.store');
    Route::get('/{id}', 'show')->name('vendor.show');
    Route::get('/{id}/edit', 'edit')->name('vendor.edit');
    Route::put('/{id}', 'update')->name('vendor.update');
    Route::delete('/{id}', 'destroy')->name('vendor.destroy');
});

//event management
Route::prefix('event')->controller(EventController::class)->group(function () {
    //under admin role since it have got all events view
    Route::get('/', 'index')->name('event.index');
    //both admin and organizer can access this route
    // Route::get('/create', 'create')->name('event.create');
    // Route::post('/store', 'store')->name('event.store');
//admin can get all event's show but for organizer the user should only see and edit what they created
    Route::get('/{id}', 'show')->name('event.show');
    Route::get('/{id}/edit', 'edit')->name('event.edit');
    Route::put('/{id}', 'update')->name('event.update');
    Route::delete('/{id}', 'destroy')->name('event.destroy');
});

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
// Route::get('/vendors',function(){
    
// });

Route::get('/vendors',[VendorsController::class,'allVendors'])->name('vendors.all');


//home page route
Route::get('/', [HomeController::class,'index']
)->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/home',function(){
//     return Inertia::render('EventType/AppHeader');
// });




//future under organizer and admin role
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


 
Route::middleware(['auth'])->get('/dashboard', [DashboardRedirectController::class, 'redirectToDashboard'])->name('dashboard');

Route::get('/debug-role', function() {
    $user = auth()->user();
    return [
        'user' => $user->id ?? null,
        'roles' => $user ? $user->getRoleNames() : 'not logged in',
    ];
});




require __DIR__.'/auth.php';