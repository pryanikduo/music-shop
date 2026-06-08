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
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign(['user_id'], 'cart_items_ibfk_1')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['product_id'], 'cart_items_ibfk_2')->references(['product_id'])->on('products')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign('cart_items_ibfk_1');
            $table->dropForeign('cart_items_ibfk_2');
        });
    }
};
