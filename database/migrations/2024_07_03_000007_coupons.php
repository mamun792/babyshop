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
        // Coupons table
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('code')->unique(); // Unique coupon code
            $table->decimal('discount_amount', 8, 2); // Discount amount (can be used for both fixed amount and percentage)
            $table->date('valid_from'); // Start date of validity
            $table->date('expiry_date'); // Expiry date of the coupon
            $table->unsignedInteger('usage_limit')->default(1); // Usage limit (ensures non-negative values)
            $table->enum('discount_type', ['fixed', 'percentage']); // Type of discount
            $table->timestamps(); // Created and updated timestamps

            // Optional: Add an index for faster querying if needed in the future
            // $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
