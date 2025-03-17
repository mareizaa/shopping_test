<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'reference' => $this->faker->unique()->bothify('REF##'), 
            'value' => $this->faker->numberBetween(100, 10000),
            'user_id' => User::factory(),
        ];
    }
}
