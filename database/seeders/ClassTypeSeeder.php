<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classTypes = [
            'Mathematics',
            'Physics',
            'Chemistry',
            'Biology',
            'Computer Science',
            'English',
            'History',
            'Geography',
            'Foreign Language',
            'Literature',
            'Economics',
            'Art',
            'Music',
            'Philosophy',
            'Political Science',
            'Psychology',
            'Sociology',
            'Statistics'
        ];

        foreach ($classTypes as $type) {
            ClassType::create(['name' => $type]);
        }
    }
}
