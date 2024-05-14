<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tsg>
 */
class TsgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'middle_name' => fake()->optional()->lastName(),
            'suffix' => fake()->optional()->suffix(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'age' => fake()->numberBetween($min = 18, $max = 60),
            'emp_id' => fake()->unique()->uuid(),
            'gender' => fake()->randomElement(["Male", "Female", "Other"])
            
        ];
    }
}
