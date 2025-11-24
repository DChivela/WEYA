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
        Schema::create('passeios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2)->default(0);
            $table->dateTime('duracao_horas')->nullable();
            $table->string('local_partida')->nullable();
            $table->string('destino')->nullable();
            $table->json('itinerario')->nullable(); // array de etapas
            $table->json('atividades')->nullable(); // array de atividades
            $table->json('dicas_user')->nullable(); // array para as dicas do usuário
            $table->json('destaque')->nullable(); // array para destacar pontos do passeio
            $table->integer('vagas')->nullable();
            $table->boolean('ativo')->default(true);
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passeios');
    }
};
