<?php

namespace Database\Seeders;

use App\Models\AssignmentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignmentTypes = [
            'Homework',
            'Quiz',
            'Test',
            'Project',
            'Lab',
            'Final Exam',
            'Midterm Exam',
            'Presentation',
            'Research Paper',
            'Essay',
            'Group Work'
        ];

        foreach ($assignmentTypes as $type) {
            AssignmentType::create(['name' => $type]);
        }
    }
}
