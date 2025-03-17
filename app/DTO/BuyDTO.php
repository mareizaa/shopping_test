<?php

namespace App\DTO;

use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class BuyDTO
{
    public int $total;
    public int $amount;

    public function __construct(
        public int $paymentId,
        public  int $stateId,
        public int $userId,
        public array $products
    )
    {}

    public static function fromRequest(array $data): self
    {
        return new self(
            paymentId: $data['payment_id'] ?? 1,
            stateId: 1,
            userId: $data['user_id'],
            products: $data['products'],
        );
    }
}
