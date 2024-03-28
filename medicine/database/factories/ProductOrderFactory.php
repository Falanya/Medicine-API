<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductOrder>
 */
class ProductOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order_id = Order::inRandomOrder()->first();
        $productId = Product::inRandomOrder()->first();
        $price = $productId->discount > 0 && $productId->discount < $productId->price ? $productId->discount : $productId->price;
        return [
            'order_id' => $order_id->id,
            'product_id' => $productId->id,
            'quantity' => $this->faker->numberBetween(1,5),
            'price' => $price,
            'status' => $order_id->status == 3 ? 1 : 0,
            'created_at' => $order_id->created_at->format('Y-m-d H:i:s'),
            'updated_at'=> $order_id->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
