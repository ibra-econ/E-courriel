<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1,5),
            'titre' => $this->faker->jobTitle(),
            'type' => $this->faker->boolean(50),
            'objet' => $this->faker->sentence(2),
            'debut' => $this->faker->dateTimeBetween('-3 days','now'),
            'fin' => $this->faker->dateTimeBetween('now'),
            'heure_debut' => $this->faker->time(),
            'heure_fin' => $this->faker->time(),
        ];
    }
}
