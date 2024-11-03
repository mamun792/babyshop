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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id'); 
            $table->unsignedBigInteger('purpose_id');

            $table->enum('transaction_type', ['credit', 'debit'])->comment('1: credit, 2: debit'); 
            $table->date('transaction_date'); 
            $table->decimal('amount', 15, 2); 

            $table->string('document')->nullable(); 
            $table->text('comments')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('purpose_id')->references('id')->on('purposes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            //  index
            $table->index('account_id');
            $table->index('purpose_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
