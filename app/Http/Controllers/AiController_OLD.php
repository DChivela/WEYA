<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use App\Models\EmbeddingDocument;
use App\Helpers\Vector;
use App\Services\g;

class AiController_OLD extends Controller
{
    public function query(Request $request, OpenAIService $openAI)
    {
        $request->validate(['q' => 'required|string']);
        $query = $request->input('q');

        // 1) embedding da query
        $queryEmbedding = $openAI->createEmbedding($query);
        if (!$queryEmbedding) {
            return response()->json(['error' => 'Falha ao criar embedding'], 500);
        }

        // 2) buscar documentos (pull todos — bom para POC)
        $docs = EmbeddingDocument::all();
        $scores = [];

        foreach ($docs as $d) {
            $docEmb = json_decode($d->embedding, true);
            if (!is_array($docEmb)) continue;
            $score = Vector::cosineSimilarity($queryEmbedding, $docEmb);
            $scores[] = ['doc' => $d, 'score' => $score];
        }

        // 3) ordena e pega top K
        usort($scores, fn($a, $b) => $b['score'] <=> $a['score']);
        $top = array_slice($scores, 0, 5);

        // 4) constrói contexto a partir dos top docs
        $context = "";
        foreach ($top as $i => $item) {
            $context .= "[".($i+1)."] " . $item['doc']->title . " — " . substr($item['doc']->content, 0, 600) . "\n\n";
        }

        // 5) prompt template
        $system = "És um assistente turístico para o sítio X. Usa apenas o contexto fornecido para responder de forma precisa e prática. Se não houver informação suficiente, diz que não tens informação e sugere contactar suporte.";
        $userPrompt = "Contexto:\n".$context."\n\nPedido do utilizador: \"$query\"\n\nInstruções: Dá 3 sugestões práticas (curtas). Para cada sugestão inclui Título, Duração, Por que é adequado, e link para mais detalhes (se houver). Mantém resposta curta.";

        $messages = [
            ['role' => 'system', 'content' => $system],
            ['role' => 'user', 'content' => $userPrompt]
        ];

        $resp = $openAI->chatCompletion($messages);

        // extrair texto (depende do formato que o OpenAIService devolve)
        $text = $resp['choices'][0]['message']['content'] ?? ($resp['choices'][0]['text'] ?? null);

        return response()->json([
            'answer' => $text,
            'sources' => array_map(fn($it) => [
                'doc_id' => $it['doc']->doc_id,
                'title' => $it['doc']->title,
                'score' => $it['score']
            ], $top)
        ]);
    }
}
