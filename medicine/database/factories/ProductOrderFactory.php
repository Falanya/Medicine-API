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
        $productId = Product::inRandomOrder()->first();
        $price = $productId->discount > 0 && $productId->discount < $productId->price ? $productId->discount : $productId->price;
        return [
            'order_id' => Order::all()->random()->id,
            'product_id' => $productId,
            'quantity' => $this->faker->numberBetween(1,50),
            'price' => $price,
        ];
    }
}
