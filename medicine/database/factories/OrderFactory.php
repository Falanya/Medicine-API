<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween("first day of January this year", "now");
        $status = $this->faker->randomElement([0, 1, 2, 3, 4]);
        $user = User::inRandomOrder()->first();
        if(!$user) {
            $user = User::factory()->create();
        }
        $addresses = $user->addresses;

        $address = null;
        if ($addresses->isNotEmpty()) {
            $address = $addresses->random();
        } else {
            $address = Address::factory()->create(['user_id' => $user->id]);
        }
        return [
            'tracking_number' => Str::random(10),
            'user_id' => $user->id,
            'address_id' => $address->id,
            'note' => $this->faker->text(255),
            'promotion_code' => Promotion::all()->random()->code,
            'status' => $status,
            'token' => $status === 0 ? Str::random(40) : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
