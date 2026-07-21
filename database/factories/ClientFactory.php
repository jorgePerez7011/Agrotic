<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'photo' => randomPhoto(),
            'document' => $this->faker->unique()->numberBetween(1234567890, 2134567890),
            'address' => $this->faker->unique()->address,
            'city' => $this->faker->city,
            'email' => $this->faker->unique()->email,
            'registered_by' => \App\Models\User::factory(),
            'status' => "1",
        ];
    }
}

function randomPhoto(): string
{
    return "dummyPhoto/" . rand(1, 15) . ".jpg";
}