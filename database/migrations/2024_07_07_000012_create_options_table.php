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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->unsignedInteger('in_stock')->default(0);
            // $table->boolean('in_stock_unlimited')->default(0);    
            // $table->unsignedInteger('price'); 
            $table->foreignId('attribute_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate(); 
            $table->timestamps();

            // Adding indexes
            $table->index('name');
            // $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
