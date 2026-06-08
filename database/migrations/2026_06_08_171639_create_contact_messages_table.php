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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->bigIncrements('contact_mess_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20)->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false)->index('contact_messages_read_idx');
            $table->dateTime('created_at')->nullable()->useCurrent()->index('contact_messages_created_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
