<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/Chutes_de_Calandula.jpg');">

        <!-- Camada de desfoque e escurecimento -->
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detalhes do Passeio
            </h2>
            <div class="mt-4 voltar">
                <a href="{{ route('passeios.index') }}" class="px-6 py-2 mt-6 bg-gray-500 text-white rounded hover:bg-gray-600">Voltar</a>
            </div>
        </x-slot>

        <div class="py-6 relative z-10 fade-in">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow-sm sm:rounded-lg p-6">
                    <div>
                        @if($passeio->foto)
                        <img src="{{ asset('storage/' . $passeio->foto) }}"
                            alt="Foto do pacote"
                            class="h-28 w-28 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                        @else
                        <div class="h-28 w-28 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                            Sem foto
                        </div>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold">{{ $passeio->nome }}</h3>
                    <p class="mt-2">{{ $passeio->descricao }}</p>
                    <p><strong>Duração:</strong> {{ $passeio->duracao_horas }} horas</p>
                    <p><strong>Local de Partida:</strong> {{ $passeio->local_partida }}</p>
                    <p><strong>Destino:</strong> {{ $passeio->destino }}</p>
                    <p><strong>História e Significado:</strong> <br> {{ $passeio->historia }}</p>
                    <p><strong>Vagas:</strong> {{ $passeio->vagas }}</p>
                    <p><strong>Ativo:</strong> {{ $passeio->ativo ? 'Sim' : 'Não' }}</p>

                    @if($passeio->atividades)
                    <div class="mt-4">
                        <strong>Atividades:</strong>
                        <ul class="list-disc list-inside">
                            @foreach($passeio->atividades as $etapa)
                            <li> {{ $etapa }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{--<p class="mt-2"><strong>Preço por pessoa:</strong> {{ number_format($passeio->preco, 2, ',', '.') }} Kz</p>--}}
                    @if($passeio->dicas_user)
                    <div class="mt-4">
                        <strong>Dicas para visitantes:</strong>
                        <ul class="list-disc list-inside">
                            @foreach($passeio->dicas_user as $item)
                            <li> {{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Fotos --}}
                    @if(!empty($passeio->fotos))
                    <div class="mt-6">
                        <strong>Fotos do Pacote:</strong>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-2">
                            @foreach($passeio->fotos as $foto)
                            <img src="{{ asset('storage/' . $foto) }}" alt="Foto do pacote"
                                class="w-full h-40 object-cover rounded border">
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="mt-6 flex justify-center">
                        {{--<a href="{{ route('comprar.pacote', $passeio->id) }}"--}}
                        <a href="{{ route('passeios.index', $passeio->id) }}"
                            class="inline-block px-6 py-3 bg-gradient-to-r from-green-500 to-blue-500
              text-gray-950 dark:text-gray-800 font-semibold rounded-full shadow-lg transform
              transition duration-300 hover:scale-105 hover:from-orange-500 hover:to-yellow-500 hover:dark:text-gray-900">
                        <i class="bi bi-car-front"></i> Adicionar ao meu passeio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
