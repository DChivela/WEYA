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
        Schema::create('motoristas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable()->index(); // opcional ligação a um usuario
            $table->string('nome');
            $table->string('email')->nullable()->index();
            $table->string('telefone')->nullable();
            $table->string('numero_cnh')->nullable()->index();
            $table->date('validade_cnh')->nullable();
            $table->string('veiculo_marca')->nullable();
            $table->string('veiculo_modelo')->nullable();
            $table->string('veiculo_placa')->nullable()->index();
            $table->enum('status', ['disponivel', 'indisponivel', 'em_viagem'])->default('disponivel');
            $table->decimal('avaliacao_media', 3, 2)->default(0.00);
            $table->json('local_atual')->nullable(); // {lat,lng}
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motoristas');
    }
};
