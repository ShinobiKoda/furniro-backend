<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);
        $skuPrefix = strtoupper(explode(' ', $name)[0]);
        $slug = Str::slug($name);
        
        $price = $this->faker->randomFloat(2, 50, 1000);
        
        return [
            'category_id' => Category::factory(), 
            'name' => ucwords($name),
            'slug' => $slug,
            'sku' => $skuPrefix . '-' . $this->faker->unique()->numberBetween(100, 999), 
            'price' => $price,
            
            // New fields added here
            'compare_at_price' => $this->faker->boolean(40) ? $price * 1.25 : null,
            'stock' => $this->faker->numberBetween(0, 90),
            'is_active' => $this->faker->boolean(80), 
            'is_featured' => $this->faker->boolean(25),
            'short_description' => $this->faker->sentence(15), 
            'description' => $this->faker->paragraphs(3, true),
            'material' => $this->faker->randomElement(['Velvet', 'Solid Oak', 'Engineered Wood', 'Leather', 'Linen', 'Brass']),
            'dimensions' => $this->faker->numberBetween(60, 220) . 'cm x ' . $this->faker->numberBetween(40, 100) . 'cm x ' . $this->faker->numberBetween(45, 90) . 'cm',
            'image_url' => 'https://picsum.photos/seed/' . $slug . '/640/480', 
        ];
    }
}