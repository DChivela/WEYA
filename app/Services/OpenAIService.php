<?php
// app/Services/OpenAIService.php (simplificado)
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $apiKey;
    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function chat($prompt)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/responses', [
            'model' => 'gpt-5-nano',
            'input' => $prompt,
        ]);

        return $response->json();
    }

    public function createEmbedding(string $text)
    {
        $resp = $this->apiKey->post('embeddings', [
            'json' => [
                'model' => 'text-embedding-3-small', // ou o modelo que escolheres
                'input' => $text
            ]
        ]);
        $body = json_decode($resp->getBody(), true);
        return $body['data'][0]['embedding'] ?? null;
    }

    public function chatCompletion(array $messages)
    {
        $resp = $this->apiKey->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4o-mini', // exemplo
                'messages' => $messages,
                'max_tokens' => 800
            ]
        ]);
        return json_decode($resp->getBody(), true);
    }
}
