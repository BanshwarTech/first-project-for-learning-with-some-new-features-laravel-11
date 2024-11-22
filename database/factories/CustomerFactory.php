<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(0, 100),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'phone' => fake()->phoneNumber(),
            'created_at' => now()->setTimezone('Asia/Kolkata'),
            'updated_at' => now()->setTimezone('Asia/Kolkata'),
        ];
    }
}
