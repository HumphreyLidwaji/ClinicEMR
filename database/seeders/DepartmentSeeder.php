<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Human Resources',
                'description' => 'Handles recruitment, employee relations, and benefits.',
            ],
            [
                'name' => 'Finance',
                'description' => 'Manages budgets, payroll, and financial planning.',
            ],
            [
                'name' => 'IT Department',
                'description' => 'Oversees technology infrastructure and support.',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Coordinates advertising, branding, and outreach.',
            ],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
