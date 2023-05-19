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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            
            $table->string('nome',255);
            $table->string('cpf',11)->unique();
            $table->date('data_nacimento');
            $table->string('email',255);
            $table->string('telefone', 15);
            $table->foreignId('endereco_id')->nullable()->constrained('enderecos');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
