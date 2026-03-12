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
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('room_id')->primary();
            $table->string('name');
            $table->text('description');
            $table->integer('capacity', false, true);
            $table->bigInteger('price_per_night', false, true);
            $table->timestamps();

            $table->foreignUuid('room_state_id')->constrained('room_states')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
