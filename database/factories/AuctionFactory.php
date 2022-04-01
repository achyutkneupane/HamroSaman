<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 20),
            'start_at' => $this->faker->dateTimeBetween('-1 months', '-1 weeks'),
            'end_at' => $this->faker->dateTimeBetween('-3 days', '+1 weeks'),

        ];
    }
}
