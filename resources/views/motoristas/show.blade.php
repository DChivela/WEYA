<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Motorista
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg p-8 text-gray-900 dark:text-gray-100">

                {{-- Cabeçalho com foto e nome --}}
                <div class="flex items-center space-x-6">
                    <div>
                        @if($motorista->foto)
                            <img src="{{ asset('storage/' . $motorista->foto) }}"
                                 alt="Foto do motorista"
                                 class="h-28 w-28 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                        @else
                            <div class="h-28 w-28 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                                Sem foto
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">{{ $motorista->nome }}</h3>
                        <p class="text-gray-500 dark:text-gray-400">Motorista cadastrado</p>
                    </div>
                </div>

                {{-- Informações principais --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="font-semibold">Telefone:</p>
                        <p>{{ $motorista->telefone }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Email:</p>
                        <p>{{ $motorista->email ?? 'Não informado' }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Data de Nascimento:</p>
                        <p>
                            {{ $motorista->data_nascimento
                                ? \Carbon\Carbon::parse($motorista->data_nascimento)->format('d/m/Y')
                                : 'Não informado' }}
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold">Idade:</p>
                        <p>{{ $motorista->idade ? $motorista->idade . ' anos' : 'Não informado' }}</p>
                    </div>
                </div>

                {{-- Informações do veículo --}}
                <div class="mt-8">
                    <h4 class="text-lg font-semibold mb-2">Veículo</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="font-semibold">Marca:</p>
                            <p>{{ $motorista->veiculo_marca }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Modelo:</p>
                            <p>{{ $motorista->veiculo_modelo }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Placa:</p>
                            <p>{{ $motorista->veiculo_placa }}</p>
                        </div>
                    </div>
                </div>

                {{-- Avaliação --}}
                <div class="mt-8">
                    <h4 class="text-lg font-semibold mb-2">Avaliação</h4>
                    <p>
                        @if($motorista->avaliacao_media)
                            @for ($i = 0; $i < $motorista->avaliacao_media; $i++)
                                ⭐
                            @endfor
                        @else
                            <span class="text-gray-500">Sem avaliação</span>
                        @endif
                    </p>
                </div>

                {{-- Ações --}}
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('motoristas.edit', $motorista) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Editar
                    </a>
                    <a href="{{ route('motoristas.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Voltar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
