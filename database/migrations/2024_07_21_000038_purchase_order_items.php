<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //  // Create purchase_order_items table
    //  Schema::create('purchase_order_items', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
    //     $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
    //     $table->integer('quantity');
    //     $table->decimal('price', 8, 2); // Price of the product at the time of purchase
    //     $table->timestamps();
    // });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('purchase_order_items');
  
    // }
};
