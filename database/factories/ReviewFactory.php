<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id'=>Product::factory(),
            'rating'=>$this->faker->numberBetween(1,5),
            'title'=>$this->faker->words(2, true),
            'comment'=>$this->faker->sentence(3),
            'is_verified_purchase'=>$this->faker->boolean(20)

        ];
    }
}
