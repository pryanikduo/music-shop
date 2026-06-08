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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->bigIncrements('support_ticket_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('support_tickets_user_id_idx');
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['open', 'in_progress', 'closed'])->default('open')->index('support_tickets_status_idx');
            $table->text('admin_reply')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
