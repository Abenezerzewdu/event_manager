<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 demo users with vendors
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name'     => "Vendor User $i",
                'email'    => "vendor$i@example.com",
                'password' => Hash::make('password'), // simple password
            ]);

            Vendor::create([
                'user_id'        => $user->id,
                'company_name'   => "Awesome Vendor $i",
                'contact_email'  => "contact$i@example.com",
                'phone'          => '0911-000-00' . $i,
                'address'        => "Addis Ababa, Ethiopia",
                'status'         => 'approved', // approved by default
                'description'    => "We provide top-notch services for weddings, birthdays, and more. Vendor $i is known for great quality!",
                'vendors_file'   => null, // or 'vendor_files/sample.jpg' if you have a test image
                'payment_status' => 'paid',
                'plan'           => 'premium',
            ]);
        }
    }
}
