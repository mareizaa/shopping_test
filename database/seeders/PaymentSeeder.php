<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create([
            'name' => 'Tarjeta de Crédito'
        ]);
        Payment::create([
            'name' => 'Contra entrega'
        ]);
    }
}
