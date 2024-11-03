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
        // Create product_variants table
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            // $table->string('variant_name'); // e.g., Size, Color
            // $table->string('variant_value'); // e.g., Medium, Red
            // $table->decimal('price', 8, 2)->nullable(); // Price for the variant, if different
            // $table->integer('quantity')->default(0); // Stock quantity for this variant
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
