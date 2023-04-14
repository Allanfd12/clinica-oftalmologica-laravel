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
        Schema::create('remedio_receitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('remedio_id')->constrained('remedios');
            $table->foreignId('receita_id')->constrained('receitas');
            $table->string('posologia', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remedio_receitas');
    }
};
