<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => "Eugene Rey",
            'middle_name' => "Blanco", // 'optional' is a custom helper function that returns 'null' 50% of the time
            'last_name' => "Carta",
            'suffix' => null, // 'optional' is a custom helper function that returns 'null' 50% of the time
            'email' => "eugene.carta@questech.com.ph",
            'email_verified_at' => now(),
            'phone_number' => "09061064605",
            'password' => static::$password ??= Hash::make('P@ssword123!'),
            'remember_token' => Str::random(10),
            'emp_id' => "24280",
            'user_type' => "user",
            'role' => "TSG",
            'age' => 23,
            'gender' => "Male",


        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    
    
}
