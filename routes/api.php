<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventTypeController;

Route::prefix('eventtype')->group(function () {
    Route::get('/', [EventTypeController::class, 'index']);          // GET /api/eventtype
    Route::get('/create', [EventTypeController::class, 'create']);  // GET /api/eventtype/create
    Route::post('/store', [EventTypeController::class, 'store']);   // POST /api/eventtype/store
    Route::get('/{id}', [EventTypeController::class, 'show']);      // GET /api/eventtype/{id}
});

