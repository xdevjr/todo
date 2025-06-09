<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(3),
            'setor' => $this->faker->word(),
            'priority' => $this->faker->randomElement(['ALTA', 'MEDIA', 'BAIXA']),
            'status' => $this->faker->randomElement(['A FAZER', 'FAZENDO', 'PRONTO']),
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
