<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Pacote
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">{{ $pacote->nome }}</h3>
                <p class="mt-2">{{ $pacote->descricao }}</p>
                <p class="mt-2"><strong>Preço:</strong> {{ number_format($pacote->preco, 2, ',', '.') }} Kz</p>
                <p><strong>Duração:</strong> {{ $pacote->duracao_dias }} dias</p>
                <p><strong>Local de Partida:</strong> {{ $pacote->local_partida }}</p>
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
            </div>
        </div>
    </div>
</x-app-layout>
