<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $adminRole     = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    $vendorRole    = Role::firstOrCreate(['name' => 'vendor', 'guard_name' => 'web']);
    $organizerRole = Role::firstOrCreate(['name' => 'organizer', 'guard_name' => 'web']);

    $admins = User::where('is_admin', true)->get();
    foreach ($admins as $admin) {
        $admin->assignRole($adminRole);
    }
}

}
