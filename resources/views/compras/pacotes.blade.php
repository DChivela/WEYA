@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12 px-6">
    <div class="max-w-5xl mx-auto">

        <!-- Card do Pacote -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">

                <!-- Foto -->
                <div class="relative">
                    @if($pacote->foto)
                        <img src="{{ asset('storage/' . $pacote->foto) }}"
                             alt="Foto do pacote"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                            Sem foto
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-gradient-to-r from-pink-500 to-red-500 text-white px-4 py-2 rounded-full shadow-lg">
                        {{ number_format($pacote->preco, 2, ',', '.') }} Kz
                    </div>
                </div>

                <!-- Informações -->
                <div class="p-8 flex flex-col justify-between">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-2">
                            {{ $pacote->nome }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $pacote->descricao }}</p>

                        <ul class="space-y-2 text-gray-700 dark:text-gray-200">
                            <li><strong>Duração:</strong> {{ $pacote->duracao_dias }} dias</li>
                            <li><strong>Partida:</strong> {{ $pacote->local_partida }}</li>
                            <li><strong>Destino:</strong> {{ $pacote->destino }}</li>
                            <li><strong>Vagas:</strong> {{ $pacote->vagas }}</li>
                        </ul>
                    </div>

                    <!-- Botão de compra -->
                    <div class="mt-6">
                        <a href="#form-compra"
                           class="inline-block w-full text-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600
                                  text-white font-semibold rounded-xl shadow-lg transform transition duration-300
                                  hover:scale-105 hover:from-purple-600 hover:to-indigo-600">
                            🛒 Comprar Agora
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulário de Compra -->
        <div id="form-compra" class="mt-12 bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Finalize sua compra</h3>

            <form action="{{ route('pacotes.finalizarCompra', $pacote->id) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome Completo</label>
                    <input type="text" name="nome" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600
                                  dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600
                                  dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número de Pessoas</label>
                    <input type="number" name="quantidade" min="1" max="{{ $pacote->vagas }}" required
                           class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600
                                  dark:bg-gray-700 dark:text-gray-100 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <button type="submit"
                        class="w-full px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600
                               text-white font-semibold rounded-xl shadow-lg transform transition duration-300
                               hover:scale-105 hover:from-emerald-600 hover:to-green-500">
                    ✅ Confirmar Compra
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
