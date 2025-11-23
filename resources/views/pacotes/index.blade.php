<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/Beach.jpg');">

        {{-- Camada de desfoque e escurecimento --}}
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Lista de Pacotes Turísticos
            </h2>
        </x-slot>

        {{-- Conteúdo --}}
        <div class="relative z-10 py-10 fade-in">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="{{ route('pacotes.create') }}"
                    class="mb-6 inline-block bg-gradient-to-r bg-blue-600 from-blue-600 to-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:scale-105 transform transition duration-300">Novo Pacote</a>

                @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-white/90 dark:bg-gray-900/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-xl border border-gray-200/20">
                    <div class="p-6 text-gray-100 dark:text-gray-100">
                        <div class="space-y-6"> {{-- MAIS ESPAÇO ENTRE OS CARDS --}}
                            @foreach ($pacotes as $pacote)
                            <div class="bg-gray-200 dark:bg-gray-800 rounded-lg shadow-lg
                    hover:shadow-xl transition shadow-gray-300/70 dark:shadow-black/40 space-y-1 text-sm">

                                {{-- VERSÃO DESKTOP (visível em md+) - mantém teu layout original --}}
                                <div class="hidden md:block bg-gray-200 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition shadow-gray-300/70 dark:shadow-black/40 space-y-1 text-sm">
                                    <div class="flex p-4 gap-4 items-start">
                                        {{-- IMAGEM --}}
                                        @if ($pacote->foto)
                                        <img src="{{ asset('storage/' . $pacote->foto) }}"
                                            class="w-44 h-32 object-cover rounded-xl shadow-sm"
                                            alt="{{ $pacote->nome }}">
                                        @else
                                        <div class="w-44 h-32 bg-gray-300 dark:bg-gray-700 rounded-xl flex items-center justify-center text-gray-600">
                                            Sem imagem
                                        </div>
                                        @endif

                                        {{-- INFORMAÇÕES --}}
                                        <div class="flex-1 flex flex-col justify-between">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $pacote->nome }}</h3>
                                                <div class="mt-1 space-y-4 text-sm text-gray-600 dark:text-gray-300">
                                                    <div><i class="bi bi-geo-alt"></i> {{ $pacote->destino ?? '—' }}</div>
                                                    <div><i class="bi bi-clock"></i> {{ $pacote->duracao_dias }} dias</div>
                                                    <div class="text-green-600 font-semibold">{{ number_format($pacote->preco, 2, ',', '.') }} Kz</div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- AÇÕES (direita) --}}
                                        <div class="flex flex-col justify-between items-end space-y-2 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $pacote->ativo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                                {{ $pacote->ativo ? 'Ativo' : 'Inativo' }}
                                            </span>

                                            <div class="flex flex-col text-sm text-right mt-6">
                                                <a href="{{ route('pacotes.show', $pacote) }}" class="text-blue-600"><i class="bi bi-eye text-3xl"></i></a>

                                                @auth
                                                @if (auth()->user()->perfil === 'admin')
                                                <a href="{{ route('pacotes.edit', $pacote) }}" class="text-yellow-500"><i class="bi bi-pencil-square text-xl"></i></a>
                                                <form action="{{ route('pacotes.destroy', $pacote) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button onclick="return confirm('Tem certeza?')" class="text-red-600">
                                                        <i class="bi bi-trash text-xl"></i>
                                                    </button>
                                                </form>
                                                @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- VERSÃO MOBILE (visível em < md) - imagem em cima, info + botões abaixo --}}
                                <div class="md:hidden bg-gray-200 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition shadow-gray-300/70 dark:shadow-black/40 space-y-1 text-sm">
                                    <div class="flex flex-col p-4 gap-4">
                                        {{-- IMAGEM (topo) --}}
                                        @if ($pacote->foto)
                                        <img src="{{ asset('storage/' . $pacote->foto) }}"
                                            class="w-full h-48 object-cover rounded-xl shadow-sm"
                                            alt="{{ $pacote->nome }}">
                                        @else
                                        <div class="w-full h-48 bg-gray-300 dark:bg-gray-700 rounded-xl flex items-center justify-center text-gray-600">
                                            Sem imagem
                                        </div>
                                        @endif

                                        {{-- INFORMAÇÕES (abaixo da imagem) --}}
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $pacote->nome }}</h3>
                                            <div class="mt-2 text-sm text-gray-600 dark:text-gray-300 space-y-2">
                                                <div><i class="bi bi-geo-alt"></i> {{ $pacote->destino ?? '—' }}</div>
                                                <div><i class="bi bi-clock"></i> {{ $pacote->duracao_dias }} dias</div>
                                                <div class="text-green-600 font-semibold">{{ number_format($pacote->preco, 2, ',', '.') }} Kz</div>
                                            </div>
                                        </div>

                                        {{-- AÇÕES (stack, largura total) --}}
                                        <div class="pt-2 border-t border-gray-200 dark:border-gray-700 flex flex-col gap-2">
                                            <div class="flex items-center justify-between">
                                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $pacote->ativo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                                    {{ $pacote->ativo ? 'Ativo' : 'Inativo' }}
                                                </span>

                                                <a href="{{ route('pacotes.show', $pacote) }}" class="text-blue-600" aria-label="Ver {{ $pacote->nome }}">
                                                    <i class="bi bi-eye text-3xl"></i>
                                                </a>
                                            </div>

                                            @auth
                                            @if (auth()->user()->perfil === 'admin')
                                            <div class="flex gap-2">
                                                <a href="{{ route('pacotes.edit', $pacote) }}" class="flex-1 text-center py-2 rounded bg-yellow-50 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-100">Editar</a>

                                                <form action="{{ route('pacotes.destroy', $pacote) }}" method="POST" class="flex-1" onsubmit="return confirm('Tem certeza?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="w-full py-2 rounded bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-100">Apagar</button>
                                                </form>
                                            </div>
                                            @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            {{ $pacotes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes pulse {

                0%,
                100% {
                    opacity: 0.7;
                    text-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
                }

                50% {
                    opacity: 1;
                    text-shadow: 0 0 25px rgba(255, 255, 255, 0.9);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-pulse {
                animation: pulse 3s ease-in-out infinite;
            }

            .fade-in {
                animation: fadeIn 1.5s ease-out both;
            }
        </style>

    </div>
</x-app-layout>
