<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService
{
    public function validateStock(array $productIds, array $quantities): void
    {
        for ($i = 0; $i < count($productIds); $i++) {
            $product = Product::find($productIds[$i]);
            if (!$product) {
                throw new Exception("Product not found");
            }
            
            if ($product->quantity < $quantities[$i]) {
                throw new Exception("Insufficient stock for product: {$product->name}. Available: {$product->quantity}, Requested: {$quantities[$i]}");
            }
        }
    }

    public function updateStock(array $productIds, array $quantities): void
    {
        for ($i = 0; $i < count($productIds); $i++) {
            $product = Product::find($productIds[$i]);
            $product->quantity -= $quantities[$i];
            $product->save();
        }
    }
}
