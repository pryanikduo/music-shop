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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->bigIncrements('cart_item_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('cart_items_user_id_idx');
            $table->string('session_id', 100)->nullable()->index('cart_items_session_id_idx');
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->integer('quantity');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
