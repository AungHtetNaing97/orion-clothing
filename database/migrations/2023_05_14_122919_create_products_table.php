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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->mediumText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('regular_price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id'); // Add subcategory_id column
            $table->unsignedBigInteger('brand_id');
            $table->string('code')->unique();
            $table->tinyInteger('status')->default('0')->comment('0=visible, 1=hidden');
            $table->tinyInteger('trending')->default('0')->comment('0=no, 1=yes');
            $table->tinyInteger('featured')->default('0')->comment('0=no, 1=yes');
            // $table->tinyInteger('stock')->default('0')->comment('0=instock, 1=outofstock');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
