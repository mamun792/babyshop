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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('affiliate_refer_code')->after('is_type')->nullable();
            $table->text('commission_description')->after('affiliate_refer_code')->nullable();
            $table->decimal('affiliate_commission',20,2)->after('commission_description')->default(0);
            $table->boolean('is_commission_paid')->after('affiliate_commission')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            //
        });
    }
};
