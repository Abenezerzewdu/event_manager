<?php

namespace App\Http\Controllers;

use id;
use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     /**
     * Show all orders for the logged-in vendor
     */
    public function vendorOrders()
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            abort(403, 'Not authorized as vendor');
        }

        $orders = $vendor->orders()
            ->with(['user', 'service', 'event'])
            ->latest()
            ->get();

        return Inertia::render('Vendors/Orders', [
            'orders' => $orders,
        ]);
}

 /**
     * Show all orders placed by logged-in user
     */
    public function myOrders()
    {
        $orders = auth()->user()
            ->orders()
            ->with(['vendor', 'service', 'event'])
            ->latest()
            ->get();

        return Inertia::render('User/MyOrders', [
            'orders' => $orders,
        ]);
    }


    public function handleOrder(Request $request)
{
    $request->validate([
        'vendor_id'  => 'required|exists:vendors,id',
        'service_id' => 'required|exists:services,id',
    ]);

    $user = auth()->user();
    $events = $user->events; // assuming User hasMany Events

    if ($events->count() === 0) {
        return redirect()->route('events.create')
            ->with('error', 'You need to create an event before placing an order.');
    }

    if ($events->count() === 1) {
        // Auto-assign the only event
        return $this->store(new Request([
            'vendor_id'  => $request->vendor_id,
            'service_id' => $request->service_id,
            'event_id'   => $events->first()->id,
        ]));
    }

    // If user has many events → redirect to a "choose event" page
    return redirect()->route('orders.choose-event', [
        'vendor_id'  => $request->vendor_id,
        'service_id' => $request->service_id,
    ]);
}


public function chooseEvent(Request $request)
{
    $events = auth()->user()->events;

    return inertia('Orders/ChooseEvent', [
        'events'     => $events,
        'vendor_id'  => $request->vendor_id,
        'service_id' => $request->service_id,
    ]);
}



     /**
     * Store a new order
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'vendor_id'  => 'required|exists:vendors,id',
            'service_id' => 'required|exists:services,id',
             
        ]);

        $order = Order::create([
            'user_id'    => auth()->id(),
            'event_id'   => $request->event_id,
            'vendor_id'  => $request->vendor_id,
            'service_id' => $request->service_id,
             
        ]);

        return redirect()->back()->with('success', 'Order placed successfully!');
    }

    public function updateStatus(Request $request, Order $order)
{
    // Ensure vendor owns this order
    if ($order->vendor_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'status' => 'required|in:pending,confirmed,completed,cancelled',
    ]);

    $order->update([
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Order status updated successfully.');
}

}