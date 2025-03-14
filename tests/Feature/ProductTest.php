<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_stores_a_new_product(): void
    {
        $user = User::factory()->create();

        $productData = [
            'name' => 'Producto de prueba',
            'reference' => 'REF12',
            'value' => 1000,
            'user_id' => $user->id,
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $productData);

        $response->assertJson([
            'data' => $productData
        ]);
    }

    public function test_it_lists_all_products(): void
    {
        Product::factory()->count(3)->create();
        $response = $this->getJson('/api/products');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function test_it_updates_a_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $updatedData = [
            'name' => 'Producto actualizado',
            'reference' => 'REF13',
            'value' => 1500,
            'user_id' => $user->id,
        ];

        $response = $this->putJson("/api/products/{$product->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', $updatedData);

        $response->assertJson([
            'data' => $updatedData,
        ]);
    }

    public function test_it_shows_a_specific_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'reference' => $product->reference,
                'value' => $product->value,
                'user_id' => $product->user_id,
            ],
        ]);
    }

    public function test_it_deletes_a_product(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
