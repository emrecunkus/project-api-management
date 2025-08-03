<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $products = Product::take(2)->get();

        $total = $products[0]->price * 2 + $products[1]->price;

        $order = Order::create([
            'user_id' => $customer->id,
            'status' => 'pending',
            'total_price' => $total,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[0]->id,
            'quantity' => 2,
            'unit_price' => $products[0]->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[1]->id,
            'quantity' => 1,
            'unit_price' => $products[1]->price,
        ]);
    }
}
