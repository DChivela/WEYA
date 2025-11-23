<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/promotion_05.jpg');">

        <!-- Camada de desfoque e escurecimento -->
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detalhes do Pacote
            </h2>
            <div class="mt-4 voltar">
                <a href="{{ route('pacotes.index') }}" class="px-6 py-2 mt-6 bg-gray-500 text-white rounded hover:bg-gray-600">Voltar</a>
            </div>
        </x-slot>

        <div class="py-6 relative z-10 fade-in">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow-sm sm:rounded-lg p-6">
                    <div>
                        @if($pacote->foto)
                        <img src="{{ asset('storage/' . $pacote->foto) }}"
                            alt="Foto do pacote"
                            class="h-28 w-28 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                        @else
                        <div class="h-28 w-28 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                            Sem foto
                        </div>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold">{{ $pacote->nome }}</h3>
                    <p class="mt-2">{{ $pacote->descricao }}</p>
                    <p><strong>Duração:</strong> {{ $pacote->duracao_dias }} dias</p>
                    <p><strong>Local de Partida:</strong> {{ $pacote->local_partida }}</p>
                    <p><strong>Destino:</strong> {{ $pacote->destino }}</p>
                    <p><strong>Vagas:</strong> {{ $pacote->vagas }}</p>
                    <p><strong>Ativo:</strong> {{ $pacote->ativo ? 'Sim' : 'Não' }}</p>

                    @if($pacote->itinerario)
                    <div class="mt-4">
                        <strong>Itinerário:</strong>
                        <ul class="list-disc list-inside">
                            @foreach($pacote->itinerario as $etapa)
                            <li>{{ $etapa }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <p class="mt-2"><strong>Preço:</strong> {{ number_format($pacote->preco, 2, ',', '.') }} Kz</p>


                    {{-- Fotos --}}
                    @if(!empty($pacote->fotos))
                    <div class="mt-6">
                        <strong>Fotos do Pacote:</strong>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-2">
                            @foreach($pacote->fotos as $foto)
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto do pacote"
                                class="w-full h-40 object-cover rounded border">
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
