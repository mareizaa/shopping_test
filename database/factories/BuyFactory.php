<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuyFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'total' => $this->faker->numberBetween(100, 1000),
            'amount' => $this->faker->numberBetween(1, 10),
            'payment_id' => Payment::inRandomOrder()->first(),
            'state_id' => State::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first()
        ];
    }
}
