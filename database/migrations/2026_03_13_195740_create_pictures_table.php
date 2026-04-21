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
        Schema::create('pictures', function (Blueprint $table) {
            $table->foreignUuid('room_id')->constrained('rooms', 'room_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image_path');
            $table->timestamps();

            $table->primary(['room_id', 'image_path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
