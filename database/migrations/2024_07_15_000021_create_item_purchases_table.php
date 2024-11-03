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
        Schema::create('item_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
    
            $table->string('product_code');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2)->nullable();
    
            $table->foreignId('purchase_id')->nullable();
            $table->foreignId('product_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_purchases');
    }
};
