<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            // Core universal attributes
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            
            // Descriptions & Media
            $table->string('short_description');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();

            // The JSONB container for variable specs (material, dimensions, etc.)
            $table->jsonb('specifications')->nullable();

            $table->timestamps();
        });

        DB::statement("ALTER TABLE products ENABLE ROW LEVEL SECURITY");
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};