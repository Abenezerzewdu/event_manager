 <?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EventTypeController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::prefix('eventtype')->controller(EventTypeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create')->name('eventtype.create');
    Route::post('/store', 'store')->name('eventtype.store');
    Route::get('/{id}', 'show')->name('eventtype.show');
    Route::get('/eventtype/{id}/edit', [EventTypeController::class, 'edit'])->name('eventtype.edit');
    Route::put('/eventtype/{id}', [EventTypeController::class, 'update'])->name('eventtype.update');
        Route::delete('/{id}', 'destroy')->name('eventtype.destroy');
    Route::get('/eventtype/{id}', [EventTypeController::class, 'show'])->name('eventtype.show');

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
