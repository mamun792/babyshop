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
        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('note')->nullable();
            // $table->string('area');
            $table->enum('payment_method', ['cash', 'bkash']);
            $table->enum('delivery', ['inside', 'outside','offline']);
            $table->integer('delivery_charge');
            $table->enum('order_status' , [
                'pending',
                'processing',
                'delivered',
                'cancelled',
                'sent_to_steadfast',
                'pending_delivery',
                'returned'
            ])->default('pending');
            $table->string('steadfast_status')->nullable();
            $table->string('consignment_id')->nullable();

            
      
            $table->string('comment')->default('N/A');
            $table->string('invoice_number')->unique();
            $table->timestamps();
        });
    }

  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('orders');
    }
};
