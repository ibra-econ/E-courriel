<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courrier>
 */
class CourrierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reference' => uniqid(),
            'objet' => $this->faker->sentence(2),
            'destinateur' => $this->faker->name(),
            'emetteur' => $this->faker->name(),
            'priorite' => 'normal',
            'confidentiel' => 'OUI',
            'date' => $this->faker->date(),
            'etat' => 'A Traiter',
            'date_arriver' => $this->faker->date(),

        ];
    }
}
