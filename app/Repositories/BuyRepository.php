<?php

namespace App\Repositories;

use App\DTO\BuyDTO;
use App\Models\Buy;
use App\Models\Product;

class BuyRepository
{
    public function create(BuyDTO $buyDTO): Buy
    {
        $buy = new Buy();

        $buy->total = $buyDTO->total;
        $buy->amount = $buyDTO->amount;
        $buy->payment_id = $buyDTO->paymentId;
        $buy->state_id = $buyDTO->stateId;
        $buy->user_id = $buyDTO->userId;
        
        $buy->save();

        foreach ($buyDTO->products as $productData) {
            $product = Product::find($productData['id']);
            $subtotal = $product->value * $productData['amount'];
            $buy->products()->attach($product->id, [
                'amount' => $productData['amount'],
                'total' => $subtotal,
            ]);
        }

        return $buy;
    }

    public function findById($id): Buy
    {
        $buy = Buy::with([
            'products',
            'payment',
            'state',
            'user'
            ])->find($id);

        return $buy;
    }
}
