<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_order' => $this->faker->unique()->dateTime(),
            'total' => $this->faker->randomFloat(0, 10000, 500000),
            'route' => $this->faker->colorName(),

            'registered_by' => \App\Models\User::factory(),
            'status' => "1",

            'client_id' => \App\Models\Client::factory(),
        ];
    }
}
