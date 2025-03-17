<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        State::create([
            'name' => 'aprobado'
        ]);
        State::create([
            'name' => 'pendiente'
        ]);
        State::create([
            'name' => 'rechazado'
        ]);
    }
}
