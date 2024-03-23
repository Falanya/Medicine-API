<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['fixed','percent']);
        $discountAmount = $type === 'fixed' ? str_pad($this->faker->numberBetween(10000,500000),'5','0', STR_PAD_RIGHT) : $this->faker->numberBetween(5,50);
        $minAmount = str_pad($this->faker->numberBetween(10000,500000),'5','0', STR_PAD_RIGHT);
        $startsAt = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $expiresAt = $this->faker->dateTimeBetween($startsAt, $startsAt->format('Y-m-d') . '+1 month');
        return [
            'code' => Str::random(10),
            'name' => $this->faker->sentence(),
            'max_users' => $this->faker->numberBetween(50,200),
            'description' => $this->faker->text(255),
            'discount_amount' => $discountAmount,
            'min_amount' => $minAmount,
            'type' => $type,
            'starts_at' => $startsAt,
            'expires_at' => $expiresAt,
        ];
    }
}
