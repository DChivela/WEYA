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
        Schema::create('embeddings_documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_id');
            $table->text('title');
            $table->text('content');
            $table->json('metadata')->nullable();
            $table->longText('embedding')->nullable();
            $table->timestamp('created_at')->useCurrent();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embeddings_documents');
    }
};
