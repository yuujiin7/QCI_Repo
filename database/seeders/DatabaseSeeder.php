<?php

namespace Database\Seeders;

use App\Models\ServiceReport;
use App\Models\Tsg;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //create only 1 user
        User::factory()->create([
            'first_name' => "Eugene Rey",
            'middle_name' => "Blanco",
            'last_name' => "Carta",
            'email' => "eugene.carta@questech.com.ph",
            'phone_number' => "09061064605",
            'emp_id' => "24280",
            'user_type' => "user",
            'role' => "TSG",
            'age' => 23,
            'gender' => "Male",
            'password' => bcrypt('P@ssword123!'),
        ]);
        
        // Tsg::factory(10)->create();
        // ServiceReport::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
