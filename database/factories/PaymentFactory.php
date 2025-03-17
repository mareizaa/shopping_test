<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /** @return array<string, mixed>*/
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->text(10),
        ];
    }
}
