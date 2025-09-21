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
        Schema::table('motoristas', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('telefone');
            $table->date('data_nascimento')->nullable()->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->dropColumn(['foto', 'data_nascimento']);
        });
    }
};
