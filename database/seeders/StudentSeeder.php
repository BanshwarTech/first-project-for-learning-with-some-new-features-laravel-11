<?php

namespace Database\Seeders;

use App\Models\student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $json = File::get(path: 'database/json/students.json');

        // $students = collect(json_decode($json));
        // $students->each(function ($student) {
        //     student::create([
        //         'name' => $student->name,
        //         'email' => $student->email,
        //         'created_at' => now()->setTimezone('Asia/Kolkata'),
        //         'updated_at' => now()->setTimezone('Asia/Kolkata'),

        //     ]);
        // });

        // student::create([
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->email(),
        //     'created_at' => now()->setTimezone('Asia/Kolkata'),
        //     'updated_at' => now()->setTimezone('Asia/Kolkata'),

        // ]);

        // insert more than one fake data the use loop
        for ($i = 1; $i <= 100; $i++) {
            student::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->email(),
                'created_at' => now()->setTimezone('Asia/Kolkata'),
                'updated_at' => now()->setTimezone('Asia/Kolkata'),

            ]);
        }
    }
}
