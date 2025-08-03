<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'iPhone 15',
                'sku' => 'IPH15',
                'price' => 3499.99,
                'stock_quantity' => 10,
            ],
            [
                'name' => 'MacBook Air',
                'sku' => 'MBA2024',
                'price' => 4999.00,
                'stock_quantity' => 7,
            ],
            [
                'name' => 'Apple Watch',
                'sku' => 'AWATCH',
                'price' => 1299.49,
                'stock_quantity' => 15,
            ],
            [
                'name' => 'iPad Pro',
                'sku' => 'IPADPRO',
                'price' => 4299.95,
                'stock_quantity' => 12,
            ],
            [
                'name' => 'AirPods Pro',
                'sku' => 'AIRDPRO',
                'price' => 899.90,
                'stock_quantity' => 20,
            ],
        ]);
    }
}
