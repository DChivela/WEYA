<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\DB;
use App\Models\EmbeddingDocument;

class IndexEmbeddings extends Command
{
    protected $signature = 'ai:index {--force : Recria todos os embeddings ignorando existências}';
    protected $description = 'Indexa dados (Corridas, Motorista, PacoteTuristicos) e gera embeddings';

    public function handle(OpenAIService $openAI)
    {
        $this->info('Iniciando indexação...');

        // Tabelas a indexar: Corridas
        $corridas = DB::table('corridas')->get();
        foreach ($corridas as $r) {
            $docId = "corrida_{$r->id}";
            if (!$this->shouldIndex($docId) && !$this->option('force')) continue;

            $texto = $r->titulo . "\n" . ($r->descricao ?? '') . "\nDuração: " . ($r->duracao ?? 'N/A') . "\nPreço: " . ($r->preco ?? 'N/A') . "\nLocal: " . ($r->local ?? '');
            $embedding = $openAI->createEmbedding($texto);
            EmbeddingDocument::updateOrCreate(
                ['doc_id' => $docId],
                [
                    'title' => $r->titulo ?? "Corrida {$r->id}",
                    'content' => $texto,
                    'metadata' => json_encode(['tipo' => 'corrida', 'orig_id' => $r->id]),
                    'embedding' => json_encode($embedding)
                ]
            );
            $this->info("Indexado: {$docId}");
        }

        // Motoristas
        $motoristas = DB::table('motoristas')->get();
        foreach ($motoristas as $m) {
            $docId = "motorista_{$m->id}";
            if (!$this->shouldIndex($docId) && !$this->option('force')) continue;

            $texto = $m->nome . "\n" . ($m->resumo ?? '') . "\nIdiomas: " . ($m->idiomas ?? 'N/D');
            $embedding = $openAI->createEmbedding($texto);
            EmbeddingDocument::updateOrCreate(
                ['doc_id' => $docId],
                [
                    'title' => $m->nome,
                    'content' => $texto,
                    'metadata' => json_encode(['tipo' => 'motorista','orig_id' => $m->id]),
                    'embedding' => json_encode($embedding)
                ]
            );
            $this->info("Indexado: {$docId}");
        }

        // PacoteTuristicos
        $pacotes = DB::table('pacotes_turisticos')->get();
        foreach ($pacotes as $p) {
            $docId = "pacote_{$p->id}";
            if (!$this->shouldIndex($docId) && !$this->option('force')) continue;

            $texto = $p->nome . "\n" . ($p->descricao ?? '') . "\nInclui: " . ($p->inclui ?? '') . "\nDuração: " . ($p->duracao ?? '');
            $embedding = $openAI->createEmbedding($texto);
            EmbeddingDocument::updateOrCreate(
                ['doc_id' => $docId],
                [
                    'title' => $p->nome,
                    'content' => $texto,
                    'metadata' => json_encode(['itinerario' => 'pacote','orig_id' => $p->id]),
                    'embedding' => json_encode($embedding)
                ]
            );
            $this->info("Indexado: {$docId}");
        }

        $this->info('Indexação concluída.');
    }

    protected function shouldIndex(string $docId): bool
    {
        return EmbeddingDocument::where('doc_id', $docId)->doesntExist();
    }
}

