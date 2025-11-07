<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqService
{
    protected $baseUri;
    protected $apiKey;

    public function __construct()
    {
        // $this->baseUri = config('https://api.groq.com/v1');
        $this->baseUri = config('services.groq.base_uri');
        $this->apiKey = config('services.groq.key');
    }

    /**
     * Chamada básica à API Groq com string
     */
    public function generateText(string $prompt, string $model = 'openai/gpt-oss-20b')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUri . '/responses', [
            'model' => $model,
            'input' => $prompt,
        ]);

        if (!$response->ok()) {
            // Retorna erro detalhado
            return 'Erro ao contactar a API Groq: HTTP ' . $response->status();
        }

        $respJson = $response->json();

        // Tenta extrair texto de várias formas possíveis
        if (isset($respJson['output'])) {
            foreach ($respJson['output'] as $out) {
                if (isset($out['content']) && is_array($out['content'])) {
                    foreach ($out['content'] as $c) {
                        if (isset($c['text'])) {
                            return $c['text'];
                        }
                    }
                }
            }
        }

        return 'Não foi possível gerar resposta.';
    }


    /**
     * Chamada via chat (com array de mensagens)
     */
    public function chat(array $messages, string $model = 'llama-3.3-70b-versatile')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUri . '/chat/completions', [
            'model' => $model,
            'messages' => $messages,
        ]);

        $respJson = $response->json();
        return $respJson;
    }

    /**  * Método de teste simples para a API Groq na rota
     */
    public function testChat(string $prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUri . '/responses', [
            'model' => 'openai/gpt-oss-20b',
            'input' => $prompt
        ]);

        return $response->json();
    }
}
