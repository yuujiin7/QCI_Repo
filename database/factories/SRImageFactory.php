<?php

namespace Database\Factories;

use App\Models\SRImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SRImage>
 */
class SRImageFactory extends Factory
{
    protected $model = SRImage::class;

    public function definition()
    {
        return [
            //Sr id is a foreign key
            'filename' => $this->faker->word . '.jpg', // Generate a fake file name
            'data' => base64_encode(file_get_contents($this->faker->imageUrl())), // Generate fake image data
        ];
    }
}
