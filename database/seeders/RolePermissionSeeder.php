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
        //permissions for finance role
        $approvePayment = Permission::firstOrCreate(['name' => 'approve payments', 'guard_name' => 'admin']);
        $denyPayment = Permission::firstOrCreate(['name' => 'deny payments', 'guard_name' => 'admin']);

        // permissions for stock management
        $approveStock = Permission::firstOrCreate(['name' => 'approve stock requisitions', 'guard_name' => 'admin']);
        $denyStock = Permission::firstOrCreate(['name' => 'deny stock requisitions', 'guard_name' => 'admin']);

        // permissions for stock returns
        $approveReturn = Permission::firstOrCreate(['name' => 'approve stock returns', 'guard_name' => 'admin']);
        $denyReturn = Permission::firstOrCreate(['name' => 'deny stock returns', 'guard_name' => 'admin']);

        //roles
        $financeRole = Role::firstOrCreate(['name' => 'finance-admin', 'guard_name' => 'admin']);
        $stockManagerRole = Role::firstOrCreate(['name' => 'stock-manager', 'guard_name' => 'admin']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);

        //assign permissions to roles
        $financeRole->givePermissionTo($approvePayment);
        $financeRole->givePermissionTo($denyPayment);
        $stockManagerRole->givePermissionTo([$approveStock, $denyStock, $approveReturn, $denyReturn]);
    }
    

}
