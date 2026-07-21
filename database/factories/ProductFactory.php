<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->colorName,
            'description' => $this->faker->text,
            'image' => randomImage(),

            'registered_by' => \App\Models\User::factory(),
            'status' => "1",

            'price' => $this->faker->randomFloat(0, 1000, 10000),
            'quantity' => $this->faker->numberBetween(0, 100),

            'provider_id' => \App\Models\Provider::factory(),
        ];
    }
}

function randomImage(): string
{
    return "dummyImage/" . rand(1, 15) . ".jpg";
}