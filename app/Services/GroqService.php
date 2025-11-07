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
   public function generateText(string $prompt, string $model = 'openai/gpt-oss-20b'): string
{
    $url = rtrim($this->baseUri, '/') . '/responses';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $this->apiKey,
        'Content-Type'  => 'application/json',
    ])->post($url, [
        'model' => $model,
        'input' => $prompt,
    ]);

    if (!$response->ok()) {
        return 'Erro ao contactar a API Groq: HTTP ' . $response->status();
    }

    $respJson = $response->json();

    // 1) Procura por outputs do tipo "message" (normalmente o texto final do assistant)
    if (!empty($respJson['output']) && is_array($respJson['output'])) {
        foreach ($respJson['output'] as $out) {
            if (isset($out['type']) && $out['type'] === 'message') {
                if (!empty($out['content']) && is_array($out['content'])) {
                    foreach ($out['content'] as $c) {
                        if (isset($c['text']) && is_string($c['text'])) {
                            return trim($c['text']);
                        }
                    }
                }
            }
        }

        // 2) Se não encontrou "message", tenta o último output e extrai primeiro 'text' útil
        $last = end($respJson['output']);
        if (!empty($last['content']) && is_array($last['content'])) {
            foreach ($last['content'] as $c) {
                if (isset($c['text']) && is_string($c['text'])) {
                    return trim($c['text']);
                }
            }
        }
    }

    // 3) Fallback: tenta extrair de choices -> message -> content
    if (!empty($respJson['choices']) && is_array($respJson['choices'])) {
        foreach ($respJson['choices'] as $choice) {
            if (isset($choice['message']['content'])) {
                if (is_string($choice['message']['content'])) {
                    return trim($choice['message']['content']);
                }
                if (is_array($choice['message']['content'])) {
                    foreach ($choice['message']['content'] as $c) {
                        if (isset($c['text']) && is_string($c['text'])) {
                            return trim($c['text']);
                        }
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
