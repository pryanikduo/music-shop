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
        Schema::table('promotion_product', function (Blueprint $table) {
            $table->foreign(['promotion_id'], 'promotion_product_ibfk_1')->references(['promotion_id'])->on('promotions')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'], 'promotion_product_ibfk_2')->references(['product_id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotion_product', function (Blueprint $table) {
            $table->dropForeign('promotion_product_ibfk_1');
            $table->dropForeign('promotion_product_ibfk_2');
        });
    }
};
