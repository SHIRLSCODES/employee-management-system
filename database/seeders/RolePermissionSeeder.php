<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvePayment = Permission::firstOrCreate(['name' => 'approve payments', 'guard_name' => 'admin']);
        
        $denyPayment = Permission::firstOrCreate(['name' => 'deny payments', 'guard_name' => 'admin']);

        $financeRole = Role::firstOrCreate(['name' => 'finance-admin', 'guard_name' => 'admin']);

        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);

        $financeRole->givePermissionTo($approvePayment);

        $financeRole->givePermissionTo($denyPayment);
    }
}
