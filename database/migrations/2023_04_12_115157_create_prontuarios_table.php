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
        Schema::create('prontuarios', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 255);
            $table->string('qp', 255);
            $table->string('biomicoscopia', 255);
            $table->string('conduta', 255);
            $table->string('grau', 255);
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prontuarios');
    }
};
