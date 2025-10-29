<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'editTicket']);
        Permission::create(['name' => 'deleteTicket']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->givePermissionTo(['editTicket', 'deleteTicket']);
    }
}
