<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'category' => $this->faker->word(),
            'images' => json_encode([
                $this->faker->imageUrl(640, 480, 'products', true), 
                $this->faker->imageUrl(640, 480, 'products', true),
                $this->faker->imageUrl(640, 480, 'products', true),
            ]),
            'description' => $this->faker->sentence(),
            'created_at' => now(),
        ];
    }
}
