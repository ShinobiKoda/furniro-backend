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
       $name = $this->faker->unique()->words(2, true);
    $slug = Str::slug($name);
    $price = $this->faker->randomFloat(2, 50, 1000);

    // Master pool of all possible specifications
    $masterSpecs = [
        'sales_package' => $this->faker->randomElement(['1 x Armchair', '1 x Dining Table', '2 x Modular Sofas']),
        'model_number' => 'MOD-' . $this->faker->numerify('#####'),
        'secondary_material' => $this->faker->randomElement(['Steel', 'Engineered Wood', 'Brass', 'Glass']),
        'config' => $this->faker->randomElement(['L-Shape', 'Straight', 'Modular']),
        'upholstery_material' => $this->faker->randomElement(['Velvet', 'Leather', 'Linen', 'Cotton Blend']),
        'upholstery_color' => $this->faker->safeColorName(),
        'filling_material' => $this->faker->randomElement(['High-Density Foam', 'Memory Foam', 'Feather Down']),
        'finish_type' => $this->faker->randomElement(['Matte', 'Glossy', 'Brushed Steel']),
        'maximum_load_capacity' => $this->faker->numberBetween(80, 300) . ' kg',
        'origin_of_manufacture' => $this->faker->country(),
        'width' => $this->faker->numberBetween(50, 200) . ' cm',
        'height' => $this->faker->numberBetween(40, 180) . ' cm',
        'depth' => $this->faker->numberBetween(40, 100) . ' cm',
        'weight' => $this->faker->randomFloat(1, 5, 45) . ' kg',
        'seat_height' => $this->faker->numberBetween(40, 55) . ' cm',
        'leg_height' => $this->faker->numberBetween(10, 25) . ' cm',
        'warranty_summary' => $this->faker->randomElement(['1 Year Warranty', '2 Years Warranty', '5 Years Structural']),
        'covered_in_warranty' => 'Manufacturing defects and frame breakage under normal use.',
        'not_covered_in_warranty' => 'Normal wear and tear or misuse.',
        'domestic_warranty' => $this->faker->randomElement(['1 Year', '2 Years']),
    ];

    $selectedKeys = (array) array_rand($masterSpecs, $this->faker->numberBetween(5, 12));
    
    $specifications = [];
    foreach ($selectedKeys as $key) {
        $specifications[$key] = $masterSpecs[$key];
    }

    return [
        'category_id' => Category::factory(), 
        'name' => ucwords($name),
        'slug' => $slug,
        'sku' => strtoupper(explode(' ', $name)[0]) . '-' . $this->faker->unique()->numberBetween(100, 999), 
        'price' => $price,
        'compare_at_price' => $this->faker->boolean(40) ? $price * 1.25 : null,
        'stock' => $this->faker->numberBetween(0, 90),
        'is_active' => $this->faker->boolean(80), 
        'is_featured' => $this->faker->boolean(25),
        'short_description' => $this->faker->sentence(15), 
        'description' => $this->faker->paragraphs(3, true),
        'image_url' => 'https://picsum.photos/seed/' . $slug . '/640/480', 
        
        // Injects a randomized, unique set of specs per product
        'specifications' => $specifications,
    ];
    }
}