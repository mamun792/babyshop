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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_name');
            $table->date('purchase_date');
            $table->string('invoice_number')->unique()->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null'); 
            $table->string('document')->nullable();

            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
