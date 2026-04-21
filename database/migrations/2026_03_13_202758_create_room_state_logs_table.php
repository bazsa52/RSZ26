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
        Schema::create('room_state_logs', function (Blueprint $table) {
            $table->uuid('room_state_log_id')->primary();
            $table->foreignUuid('room_id')->constrained('rooms', 'room_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('room_state_id')->constrained('room_state_lookups', 'room_state_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_state_logs');
    }
};
