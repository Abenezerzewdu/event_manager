<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // Only orders created by this organizer
    $orders = $user->orders()->with(['vendor', 'service'])->get();

    $cartItems = $orders->map(fn($order) => [
        'id' => $order->id,
        'name' => $order->vendor->name . ' - ' . $order->service->name,
        'price' => $order->service->price,
    ]);

    return Inertia::render('Home', [
        'cartItems' => $cartItems,  
        'canLogin' => Route::has('login'), 'canRegister' => Route::has('register'),
    ]);
}

}
