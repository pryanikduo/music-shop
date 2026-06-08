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
            $table->bigIncrements('product_id');
            $table->unsignedBigInteger('category_id')->index('products_category_id_idx');
            $table->string('name');
            $table->string('slug')->index('products_slug_idx');
            $table->decimal('price', 12, 2)->index('products_price_idx');
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();

            $table->unique(['slug'], 'slug');
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
