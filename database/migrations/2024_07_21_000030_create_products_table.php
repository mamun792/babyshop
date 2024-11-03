<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Create tags table  
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

          
            $table->string('name')->nullable();
            $table->string('product_code')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 8, 2)->nullable();
           
            $table->decimal('discount_price', 8, 2)->nullable();
          
            $table->string('slug')->unique()->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('specifications')->nullable();
            $table->string('featured_image')->nullable();
            $table->text('gallery_image_one')->nullable();
            $table->text('gallery_image_two')->nullable();
            $table->text('gallery_image_three')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_flash')->default(false);
            $table->boolean('is_new_arrival')->default(false);
            //  affiliate product
            $table->boolean('is_affiliate')->default(false);
           
            
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained();
         
            $table->foreignId('user_id')->nullable()->constrained();
        


            $table->string('sold')->nullable();

            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('products');
    }
};
