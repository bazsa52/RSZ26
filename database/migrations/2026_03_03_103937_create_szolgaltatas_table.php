<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('szolgaltatasok', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 150)->index();
            $table->decimal('price', 10, 2)->default(0);
            $table->text('leiras')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['price']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('szolgaltatasok');
    }
};
?>