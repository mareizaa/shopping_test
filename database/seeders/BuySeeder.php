<?php

namespace Database\Seeders;

use App\Models\Buy;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BuySeeder extends Seeder
{
    public function run(): void
    {
        Buy::factory()->count(5)->create()->each(function ($buy) {

            $products = Product::inRandomOrder()->limit(3)->get(); 

            foreach ($products as $product) {
                $quantity = rand(1, 5);
                $subtotal = $product->value * $quantity;

                $buy->products()->attach($product->id, [
                    'total' => $subtotal,
                    'amount' => $quantity,
                ]);
            }
        });
    }
}
