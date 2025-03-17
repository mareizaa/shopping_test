<?php

namespace App\Actions;

use App\Models\Product;

class StoreOrUpdateProductAction
{
    public function execute(array $data, Product $product): Product
    {
        $product->name = $data['name'];
        $product->reference = $data['reference'];
        $product->value = $data['value'];
        $product->user_id = $data['user_id'];

        $product->save();

        return $product;
    }
}
