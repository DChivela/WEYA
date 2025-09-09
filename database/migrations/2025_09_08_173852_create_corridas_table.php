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
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('motorista_id')->nullable()->index();
            $table->string('tipo', 30)->default('regular'); // regular, pacote, compartilhada
            // origem
            $table->decimal('origem_lat', 10, 7);
            $table->decimal('origem_lng', 10, 7);
            $table->string('origem_endereco')->nullable();
            // destino
            $table->decimal('destino_lat', 10, 7);
            $table->decimal('destino_lng', 10, 7);
            $table->string('destino_endereco')->nullable();
            // metrica e preço
            $table->decimal('distancia_km', 8, 2)->nullable();
            $table->integer('duracao_segundos')->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->decimal('tarifa_base', 10, 2)->default(0);
            $table->decimal('tarifa_km', 10, 2)->default(0);
            $table->decimal('tarifa_minuto', 10, 2)->default(0);
            $table->enum('estado', ['pendente', 'aceite', 'em_andamento', 'concluida', 'cancelada'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->timestamp('agendado_para')->nullable(); // corrida agendada
            $table->timestamp('iniciada_em')->nullable();
            $table->timestamp('finalizada_em')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Chaves Estrangeiras
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corridas');
    }
};
