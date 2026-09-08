<?php

namespace Database\Factories;

use App\Models\Category; // <-- Added this
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // 1. Generate the name first so we can use it for the slug and SKU
        $name = $this->faker->unique()->words(2, true);
        
        // 2. Grab just the first word for the SKU and make it uppercase (e.g., "velvet sofa" -> "VELVET")
        $skuPrefix = strtoupper(explode(' ', $name)[0]);

        $slug = Str::slug($name);

        return [
            // Create a category on the fly and grab its ID
            'category_id' => Category::factory(), 
            
            'name' => ucwords($name),
            'slug' => $slug,
            
            // Combines the prefix with a random 3-digit number (e.g., VELVET-482)
            'sku' => $skuPrefix . '-' . $this->faker->unique()->numberBetween(100, 999), 
            
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(0, 90),
            'is_active' => $this->faker->boolean(80), 
            'short_description' => $this->faker->sentence(15), 
            
            // Faker actually has a placeholder image generator we can use for now!
            'image_url' => 'https://picsum.photos/seed/' . $slug . '/640/480', 
        ];
    }
}