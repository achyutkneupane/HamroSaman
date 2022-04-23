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
    public function definition()
    {
        $title = $this->faker->sentence(3);
        return [
            'name' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'description' => $this->faker->sentence,
            'user_id' => $this->faker->numberBetween(1, 20),
            'category_id' => $this->faker->numberBetween(1, 5),
            'min_price' => $this->faker->numberBetween(100, 1000000),
        ];
    }
}
