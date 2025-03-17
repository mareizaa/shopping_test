<?php

namespace App\Services;

use App\DTO\BuyDTO;
use App\Models\Product;
use App\Repositories\BuyRepository;

class BuyService
{
    protected $buyRepository;
    
    public function __construct(BuyRepository $buyRepository)
    {
        $this->buyRepository = $buyRepository;
    }

    public function registerBuy(BuyDTO $buyDTO)
    {
        $total = 0;
        $amount = 0;

        foreach ($buyDTO->products as $productData) {
            $product = Product::find($productData['id']);
            $total += $product->value * $productData['amount'];
            $amount += $productData['amount'];
        }

        $buyDTO->total = $total;
        $buyDTO->amount = $amount;

        return $this->buyRepository->create($buyDTO);
    }
}
