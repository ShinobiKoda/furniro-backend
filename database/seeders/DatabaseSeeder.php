<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creates 5 categories, and uses the products() relationship 
        // in your model to attach 10 random products to each one.
        {
        // 1. Create 5 Categories
        Category::factory(5)
            ->has(
                // 2. For each category, create 10 Products
                Product::factory(10)
                    ->has(
                        // 3. For each product, create 3 Reviews
                        Review::factory(3), 
                        'reviews' // Matches the reviews() relationship on Product
                    ),
                'products' // Matches the products() relationship on Category
            )
            ->create();
    }

       
    }
}
