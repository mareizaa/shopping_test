<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'products' => $this->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'value' => $product->value,
                    'amount' => $product->pivot->amount,
                    'total' => $product->pivot->total,
                ];
            }),
            'state' => [
                'id' => $this->state->id,
                'name' => $this->state->name,
            ],
            'total' => $this->total,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'payment' => [
                'id' => $this->payment->id,
                'name' => $this->payment->name,
            ],
        ];
    }
}
