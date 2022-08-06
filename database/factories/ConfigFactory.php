<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Config>
 */
class ConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'description' => $this->faker->sentence(),
            'contact' => $this->faker->phoneNumber(),
            'logo' => $this->faker->imageUrl(110,110),
        ];
    }
}
