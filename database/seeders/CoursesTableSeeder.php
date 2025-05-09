<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = ['Beginner', 'Intermediate', 'Advanced'];

        for ($i = 1; $i <= 10; $i++) {
            \DB::table('courses')->insert([
                'name' => 'Course ' . $i,
                'description' => 'This is a description for Course ' . $i,
                'duration' => rand(1, 50), // Random duration between 1 and 50 hours
                'price' => rand(50, 500), // Random price between 50 and 500
                'level' => $levels[array_rand($levels)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
