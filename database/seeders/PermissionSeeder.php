<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'assign permissions',
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view goals',
            'create goals',
            'update goals',
            'delete goals',
            'review performance',
            'submit performance feedback',
            'manage appraisals',
            'view reports',
            'export reports',
            'generate custom reports',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin',]);
            
        }
    }
}
