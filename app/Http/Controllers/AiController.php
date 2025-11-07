<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroqService;

class AiController extends Controller
{
    protected $groq;

    public function __construct(GroqService $groq)
    {
        $this->groq = $groq;
    }

    /**
     * Endpoint simples de teste (GET)
     */
    public function test()
    {
        $prompt = "Escreve uma frase curta de boas-vindas para turistas em Angola.";

        $answer = $this->groq->generateText($prompt);

        return response()->json([
            'answer' => $answer
        ]);
    }

    /**
     * Endpoint para perguntas via POST (com JSON)
     */
    public function query(Request $request)
    {
        $request->validate(['q' => 'required|string']);
        $query = $request->input('q');

        // Prompt de sistema (identificação + contexto)
        $system = "És um assistente turístico para o site Vakwetu Weya.
Usa apenas o contexto fornecido para responder de forma precisa e prática.
Se não houver informação suficiente, diz que não tens informação e sugere contactar suporte.
Sistema desenvolvido por uma equipa totalmente jovem, situados no sul de Angola.
Por: Marcos Kafanda, Domingos Chivela...";

        // Dados do sistema / pacotes
        $pacotes = \App\Models\PacoteTuristico::all();
        if ($pacotes->isEmpty()) {
            $pacotesData = [
                [
                    'titulo' => 'Escape da Cidade',
                    'duracao' => '3 dias',
                    'porque' => 'Ideal para relaxar e fugir do stress urbano',
                    'link' => 'https://example.com/escape-da-cidade'
                ],
                [
                    'titulo' => 'Aventura na Natureza',
                    'duracao' => '5 dias',
                    'porque' => 'Perfeito para quem gosta de atividades ao ar livre',
                    'link' => 'https://example.com/aventura-na-natureza'
                ],
                [
                    'titulo' => 'Cultura e Gastronomia',
                    'duracao' => '7 dias',
                    'porque' => 'Explora museus, tradições locais e culinária típica',
                    'link' => 'https://example.com/cultura-gastronomia'
                ],
            ];
        } else {
            $pacotesData = $pacotes->map(function ($p) {
                return [
                    'nome' => $p->nome,
                    'duracao_dias' => $p->duracao_dias ?? 'não especificado',
                    'preco' => $p->preco ?? 'Pacote turístico interessante',
                    'itinerario' => $p->link ?? '#'
                ];
            });
        }

        // Monta o prompt completo para a IA
        $prompt = $system . "\n\nSugere até 3 pacotes turísticos curtos, cada um com: Título, Duração, Por que é adequado e com um intervalo de preços.
        Use os dados abaixo, sem precisar simular uma tabela, formate como uma lista ordenada ou desordenada com paragráfos bem definidos para cada ponto. Não use markdown:\n\n";
        foreach ($pacotesData as $p) {
            $prompt .= "- <h3>Descrição:</h3> {$p['nome']}, Duração: {$p['duracao_dias']}, Preco: {$p['preco']}, Itinerário: {$p['itinerario']}\n";
        }
        $prompt .= "\nPergunta do turista: $query";

        // Chama a IA
        $answer = $this->groq->generateText($prompt);

        return response()->json(['answer' => $answer]);
    }
}
