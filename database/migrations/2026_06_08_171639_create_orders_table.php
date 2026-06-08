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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('orders_user_id_idx');
            $table->string('order_number', 50)->unique('order_number');
            $table->enum('status', ['new', 'paid', 'shipped', 'cancelled'])->default('new')->index('orders_status_idx');
            $table->decimal('total_price', 12, 2);
            $table->text('delivery_address');
            $table->string('phone', 20);
            $table->text('comment')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();

            $table->index(['order_number'], 'orders_order_number_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
