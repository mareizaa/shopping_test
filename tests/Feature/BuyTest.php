<?php

namespace Tests\Feature;

use App\Models\Buy;
use App\Models\Product;
use App\Models\State;
use App\Models\Payment;
use App\Models\User;
use Database\Seeders\BuySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuyTest extends TestCase
{
    use RefreshDatabase;

    public function test_buy_is_stored_correctly()
    {
        $user = User::factory()->create();
        $state = State::factory()->create();
        $payment = Payment::factory()->create();
        $product1 = Product::factory()->create(['value' => 100]);
        $product2 = Product::factory()->create(['value' => 200]);

        $requestData = [
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'products' => [
                ['id' => $product1->id, 'amount' => 2],
                ['id' => $product2->id, 'amount' => 3],
            ],
        ];

        $response = $this->postJson('/api/buys', $requestData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Compra registrada exitosamente',
            ]);

        $this->assertDatabaseHas('buys', [
            'payment_id' => $payment->id,
            'state_id' => $state->id,
            'user_id' => $user->id,
            'total' => 800,
            'amount' => 5,
        ]);

        $buyId = $response->json('buy.id'); // Obtener el ID de la compra creada
        $this->assertDatabaseHas('buy_product', [
            'buy_id' => $buyId,
            'product_id' => $product1->id,
            'amount' => 2,
            'total' => 200, // 100 * 2 = 200
        ]);
        $this->assertDatabaseHas('buy_product', [
            'buy_id' => $buyId,
            'product_id' => $product2->id,
            'amount' => 3,
            'total' => 600, // 200 * 3 = 600
        ]);
    }

    public function test_show_buy_returns_correct_data()
    {
        User::factory()->create();
        State::factory()->create();
        Payment::factory()->create();
        Product::factory()->count(5)->create();
        $this->seed(BuySeeder::class);

        $buy = Buy::first();

        $response = $this->getJson("/api/buys/{$buy->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'name',
                    ],
                    'products' => [
                        '*' => [
                            'id',
                            'name',
                            'value',
                            'amount',
                            'total',
                        ],
                    ],
                    'state' => [
                        'id',
                        'name',
                    ],
                    'total',
                    'amount',
                    'created_at',
                    'updated_at',
                    'payment' => [
                        'id',
                        'name',
                    ],
                ],
            ]);
    }
}