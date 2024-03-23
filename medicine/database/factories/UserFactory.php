<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('first day of January this year', 'now');
        $emailVerified = $this->faker->dateTimeBetween($createdAt, '+1 week');
        return [
            'fullname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement([0,1]),
            'birthday' => fake()->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'),
            'email_verified_at' => $emailVerified,
            'password' => static::$password ??= Hash::make('123456'),
            'created_at' => $createdAt,
            'updated_at'=> $createdAt,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
