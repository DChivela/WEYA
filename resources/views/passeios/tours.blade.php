<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/Chutes_De_Calandula.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Passeios Turísticos na Huíla
            </h2>
        </x-slot>

        <div class="relative z-10 py-10 fade-in">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- Mensagem de sucesso --}}
                @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Lista de passeios --}}
                <div class="bg-white/90 dark:bg-gray-900/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-xl border border-gray-200/20">
                    <div class="p-6 text-gray-100 dark:text-gray-100 space-y-6">
                        @foreach ($passeiosTour as $passeio)
                        <div class="bg-gray-200 dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition space-y-1 text-sm">
                            <div class="flex p-4 gap-4 items-start">
                                {{-- Imagem --}}
                                @if ($passeio->foto)
                                <img src="{{ asset('storage/' . $passeio->foto) }}"
                                    class="w-44 h-32 object-cover rounded-xl shadow-sm"
                                    alt="{{ $passeio->nome }}">
                                @else
                                <div class="w-44 h-32 bg-gray-300 dark:bg-gray-700 rounded-xl flex items-center justify-center text-gray-600">
                                    Sem imagem
                                </div>
                                @endif

                                {{-- Informações --}}
                                <div class="flex-1 flex flex-col justify-between">
                                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $passeio->nome }}</h3>
                                    <div class="mt-1 space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                        <div><i class="bi bi-geo-alt"></i> {{ $passeio->destino ?? '—' }}</div>
                                        <div><i class="bi bi-clock"></i> {{ $passeio->duracao_horas }} horas</div>
                                        <div class="text-green-600 font-semibold"><i class="bi bi-cash"></i> {{ number_format($passeio->preco, 2, ',', '.') }} Kz</div>
                                    </div>
                                </div>

                                {{-- Ações --}}
                                <div class="flex flex-col justify-between items-end space-y-2 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $passeio->ativo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                        {{ $passeio->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                    <div class="flex flex-col text-sm text-right mt-6 space-y-2">
                                        <a href="{{ route('passeios.show', $passeio) }}" class="text-blue-600"><i class="bi bi-eye text-3xl"></i></a>
                                        <button
                                            class="btn-selecionar bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm"
                                            data-id="{{ $passeio->id }}"
                                            data-nome="{{ $passeio->nome }}">
                                            Selecionar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="mt-4">
                            {{ $passeiosTour->links() }}
                        </div>
                    </div>
                </div>

                {{-- Resumo fixo --}}
                <div class="mt-10 bg-white/80 dark:bg-gray-900/80 p-6 rounded-xl shadow-lg sticky bottom-0 z-50">
                    <h3 class="text-lg font-bold mb-2 dark:bg-gray-100">Resumo do Passeio</h3>
                    <ul id="lista-selecionados" class="list-disc pl-5 text-sm text-gray-800 dark:text-gray-200"></ul>
                    <p class="mt-4 font-semibold text-blue-700 dark:text-blue-400">
                        Orçamento Total: <span id="orcamento">50.000 Kz</span>
                    </p>
                    <small class="rounded-xl text-green-700">O passeio é cobrado por carro, independente do número de passageiros.
                        Preço fixo até 3 locais, depois +10.000 Kz por cada local adicional.
                    </small>
                    <div class="mt-6 flex justify-center">
                        {{--<a href="{{ route('comprar.pacote', $passeio->id) }}"--}}
                        <a href="{{ route('passeios.index', $passeio->id) }}"
                            class="inline-block px-6 py-3 bg-gradient-to-r from-green-500 to-blue-500
              text-gray-950 dark:text-gray-800 font-semibold rounded-full shadow-lg transform
              transition duration-300 hover:scale-105 hover:from-orange-500 hover:to-yellow-500 hover:dark:text-gray-900">
                            <i class="bi bi-car-front"></i> Confirmar Passeio
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Script de seleção --}}
        <script>
            const selecionados = new Set();
            const lista = document.getElementById('lista-selecionados');
            const orcamento = document.getElementById('orcamento');
            const base = 50000;
            const extra = 10000;

            document.querySelectorAll('.btn-selecionar').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const nome = btn.dataset.nome;

                    if (!selecionados.has(id)) {
                        selecionados.add(id);
                        const item = document.createElement('li');
                        item.textContent = nome;
                        lista.appendChild(item);
                        atualizarOrcamento();
                    }
                });
            });

            function atualizarOrcamento() {
                let total = base;
                if (selecionados.size > 3) total += extra;
                orcamento.textContent = total.toLocaleString('pt-AO') + ' Kz';
            }
        </script>
    </div>
</x-app-layout>
