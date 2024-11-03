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

        // Create order_items table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('campaign_id')->nullable();
            $table->integer('quantity');
           
            // $table->foreignId('option_id')->nullable()->constrained('product_options')->nullOnDelete();
            $table->decimal('price', 8, 2)->comment('After deducting coupon amount if any and also remember that if price and discount price both is avaiable is products table then discount_price is used as product price');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->enum('coupon_discount_type',['fixed', 'percentage'])->nullable();
            $table->enum('is_type', ['checkout', 'pos'])->default('checkout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
