<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SR>
 */
class SRFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sr_number' => fake()->unique()->uuid(),
            'event_id' => fake()->unique()->uuid(),
            'date' => fake()->date(),
            'customer_name' => fake()->Name(),
            'address' => fake()->address(),
            'contact_person' => fake()->Name(),
            'contact_number' => fake()->phoneNumber(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            //make a function to calculate the total hours difference between 'start_time' and 'end_time' and store it in a column called
            //  'total_hours' in the database table
            'total_hours' => 'end_time' - 'start_time',
            'remarks' => fake()->sentence(),
            //make a function that will return a boolean True or False
            'new_installation' => fake()->boolean(),
            'staus_1' => fake()->randomElement(["New Installation", "Under Warranty", "Demo/POC", "Billable", "Others","Corrective Maintenance","Under Maintenance Contract", "Add-On Value"]),
            'machine_model' => fake()->randomElement(["Xerox", "Canon", "Ricoh", "Konica Minolta", "Sharp", "Kyocera", "Toshiba", "Others", "HP", "Lenovo"]),
            'machine_serial_number' => fake()->unique()->uuid(),
            "product_number" => fake()->unique()->uuid(),
            "part_number" => fake()->randomNumber(0, 10000000),
            "part_quantity" => fake()->randomNumber(0, 100),
            "part_description" => fake()->sentence(),
            "part_usage" => fake()->randomNumber(0, 100),
            "action_taken" => fake()->sentence(),
            "pending" => fake()->sentence(),
            "status_2" => fake()->randomElement(["Incomplete", "Completed"]),
            "engineer_assigned" => fake()->Name(),
            "tech_support" => fake()->Name(),
            "hr_finance" => fake()->Name(),
            "evp_coo" => fake()->Name(),
            

            
            
        ];
    }
}
