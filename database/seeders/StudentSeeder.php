<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create(['name' => 'John Doe','email' => 'jd@mail.com','phone' => '1234567890','address' => '123 Main St','date_of_birth' => '2000-01-01']);
        Student::create(['name' => 'Alex','email' => 'gh@mail.com','phone' => '1234567890','address' => '123 Main St','date_of_birth' => '2000-01-01']);
        Student::create(['name' => 'james','email' => 'sd@mail.com','phone' => '1234567890','address' => '123 Main St','date_of_birth' => '2000-01-01']);
        Student::create(['name' => 'Jaffer','email' => 'yj@mail.com','phone' => '1234567890','address' => '123 Main St','date_of_birth' => '2000-01-01']);
        Student::create(['name' => 'Siraj','email' => 'yh@mail.com','phone' => '1234567890','address' => '123 Main St','date_of_birth' => '2000-01-01']);

    }
}
 