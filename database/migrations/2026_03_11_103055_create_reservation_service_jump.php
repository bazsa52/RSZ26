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
        Schema::create('reservation_service_jump', function (Blueprint $table) {
            $table->foreignUuid('reservation_id')->constrained('reservations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('extra_service_id')->constrained('extra_services')->cascadeOnDelete()->cascadeOnUpdate();

            $table->primary(['reservation_id', 'extra_service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_service_jump');
    }
};
