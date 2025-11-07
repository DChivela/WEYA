<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PacoteTuristicoController;
use App\Http\Controllers\PromocaoController;
use App\Http\Controllers\AiController;
use App\Services\GroqService;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/corridas', CorridaController::class);
    Route::resource('/motoristas', MotoristaController::class);
    Route::resource('/pacotes', PacoteTuristicoController::class);
    Route::resource('/promocoes', PromocaoController::class);
});

Route::post('/ai/query', [AiController::class, 'query']);
// Route::get('/test-ai', function (): JsonResponse {
//     $service = new OpenAIService();
//     $result = $service->chat('Escreve um haiku sobre turismo em Angola.');
//     return response()->json($result);
// });

//Teste rápido para Groq AI
Route::get('/test-groq', function (GroqService $groq) {
    $resp = $groq->testChat("Escreve uma frase curta de boas-vindas para turistas em Angola.");

    // Extrair só o texto da resposta
    $text = $resp['output'][1]['content'][0]['text'] ?? null;

    return response()->json([
        'answer' => $text
    ]);
});


require __DIR__ . '/auth.php';
