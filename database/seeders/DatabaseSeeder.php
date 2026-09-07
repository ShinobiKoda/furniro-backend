<?php

namespace Database\Seeders;

use App\Models\Category;
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
        Category::factory(5)->hasProducts(10)->create();

       
    }
}
