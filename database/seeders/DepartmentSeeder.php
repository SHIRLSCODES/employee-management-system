<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Business Application Technical',
                'code' => 'BAT'
            ],
            [
                'name' => 'Business Application Functional',
                'code' => 'BAF'
            ],
            [
                'name' => 'Business Application Support',
                'code' => 'BAS'
            ],
            [
                'name' => 'Human Resource',
                'code' => 'HR'
            ],
            [
                'name' => 'Modern Workspace',
                'code' => 'MW'
            ],
            [
                'name' => 'Business Development',
                'code' => 'BD'
            ]
        ];

        foreach($departments as $department)
        {
            Department::updateOrCreate($department);
        }
    }
}
