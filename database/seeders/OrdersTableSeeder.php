<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Using existing IDs
        $userId = 1;
        $vendorId = 1;
        $serviceId = 1;
        $eventId = 1;

        // Create a pending order
        Order::create([
            'user_id'    => $userId,
            'vendor_id'  => $vendorId,
            'service_id' => $serviceId,
            'event_id'   => $eventId,
            'status'     => 'pending',
        ]);

        // Create a confirmed order
        Order::create([
            'user_id'    => $userId,
            'vendor_id'  => $vendorId,
            'service_id' => $serviceId,
            'event_id'   => $eventId,
            'status'     => 'confirmed',
        ]);
    }
}
