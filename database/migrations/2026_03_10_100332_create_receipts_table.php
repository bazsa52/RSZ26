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
        Schema::create('receipts', function (Blueprint $table) {
            $table->uuid('receipt_id')->primary();
            $table->bigInteger('total', false, true);
            $table->timestamps();

            $table->foreignUuid('user_id')->constrained('users', 'user_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('reservation_id')->constrained('reservations', 'reservation_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('payment_status_id')->constrained('payment_statuses', 'payment_status_id')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
