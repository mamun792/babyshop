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
        Schema::create('consignments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->string('recipient_name', 100);
            $table->string('recipient_phone', 11);
            $table->string('recipient_address', 250);
            $table->decimal('cod_amount', 10, 2);
            $table->string('note')->nullable();
            $table->string('tracking_code')->unique()->nullable();
            $table->enum('status', [
                'pending', 'delivered_approval_pending', 'partial_delivered_approval_pending', 
                'cancelled_approval_pending', 'unknown_approval_pending', 'delivered', 
                'partial_delivered', 'cancelled', 'hold', 'in_review', 'unknown'
            ])->default('in_review');
            $table->boolean('is_bulk')->default(false); // Indicates if the order is part of a bulk order
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignments');
    }
};
