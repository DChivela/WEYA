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
Schema::create('usuarios', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->string('email')->unique();
    $table->string('telefone')->nullable()->index();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->enum('perfil', ['usuario','admin'])->default('usuario'); // perfil do sistema
    $table->decimal('credito', 10,2)->default(0); // saldo/balanco
    $table->json('meta')->nullable(); // dados adicionais flexíveis
    $table->rememberToken();
    $table->timestamps();
    $table->softDeletes();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
