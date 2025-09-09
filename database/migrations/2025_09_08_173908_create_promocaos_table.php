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
        Schema::create('promocaos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('descricao')->nullable();
            $table->decimal('desconto_percent', 5, 2)->nullable();
            $table->decimal('desconto_valor', 10, 2)->nullable();
            $table->date('validade_de')->nullable();
            $table->date('validade_ate')->nullable();
            $table->integer('uso_maximo')->nullable(); // quantas vezes pode ser usado globalmente
            $table->integer('uso_por_usuario')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promocaos');
    }
};
