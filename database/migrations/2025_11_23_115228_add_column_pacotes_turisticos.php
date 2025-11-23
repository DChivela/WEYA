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
                Schema::table('pacotes_turisticos', function (Blueprint $table) {
            $table->json('incluido')->nullable()->after('itinerario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
                Schema::table('pacotes_turisticos', function (Blueprint $table) {
            $table->dropColumn('incluido');
        });
    }
};
