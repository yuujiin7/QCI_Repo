<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SR>
 */
class ServiceReportFactory extends Factory
{

     /**
     * Starting sr number.
     *
     * @var int
     */
    private static $currentSrNumber = 0;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_time = $this->faker->time();
        $end_time = $this->faker->time();
        $total_hours = $this->calculateTotalHours($start_time, $end_time);
        $srNumber = str_pad(++self::$currentSrNumber, 6, '0', STR_PAD_LEFT);
        return [
            //make sr_number number increasing
            'sr_number' => $srNumber,
            'event_id' => $this->faker->unique()->uuid(),
            'date' => $this->faker->date(),
            'customer_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'contact_person' => $this->faker->name(),
            'contact_number' => $this->faker->phoneNumber(),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'total_hours' => $total_hours,
            'remarks' => $this->faker->sentence(),
            'new_installation' => $this->faker->boolean(),
            'status_1' => $this->faker->randomElement(["New Installation", "Under Warranty", "Demo/POC", "Billable", "Others","Corrective Maintenance","Under Maintenance Contract", "Add-On Value"]),
            'machine_model' => $this->faker->randomElement(["Xerox", "Canon", "Ricoh", "Konica Minolta", "Sharp", "Kyocera", "Toshiba", "Others", "HP", "Lenovo"]),
            'machine_serial_number' => $this->faker->unique()->uuid(),
            "product_number" => $this->faker->unique()->uuid(),
            "part_number" => $this->faker->numberBetween(0, 10000000),
            "part_quantity" => $this->faker->numberBetween(0, 100),
            "part_description" => $this->faker->sentence(),
            "part_usage" => $this->faker->numberBetween(0, 100),
            "action_taken" => $this->faker->sentence(),
            "pending" => $this->faker->sentence(),
            "status_2" => $this->faker->randomElement(["Incomplete", "Completed"]),
            "engineer_assigned" => $this->faker->name(),
            "tech_support" => $this->faker->name(),
            "hr_finance" => $this->faker->name(),
            "evp_coo" => $this->faker->name(),
        ];
    }
    /**
     * Calculate total hours between start and end time.
     *
     * @param string $start_time
     * @param string $end_time
     * @return float
     */
    private function calculateTotalHours($start_time, $end_time): float
    {
        $start = \DateTime::createFromFormat('H:i:s', $start_time);
        $end = \DateTime::createFromFormat('H:i:s', $end_time);
        $interval = $start->diff($end);
        return (float)$interval->format('%H') + ((float)$interval->format('%i') / 60);
    }
}
