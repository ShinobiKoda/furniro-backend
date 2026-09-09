<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('products', function (Blueprint $table) {
        // Drop the existing foreign key constraint and column
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });

    Schema::table('products', function (Blueprint $table) {
        $table->foreignId('category_id')
              ->nullable()
              ->after('id')
              ->constrained()
              ->nullOnDelete();
        $table->decimal('compare_at_price', 10,2)->nullable();
        $table->text('description')->nullable();
        $table->boolean('is_featured')->default(true);
        $table->string('material')->nullable();
        $table->string('dimensions')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn([
            'category_id',
            'compare_at_price',
            'description',
            'is_featured',
            'material',
            'dimensions'
        ]);
    });

    
    }
};
