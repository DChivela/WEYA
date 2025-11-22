<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/driver_01.jpg');">

        <!-- Camada de desfoque e escurecimento -->
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Corridas') }}
            </h2>
        </x-slot>

        <!-- Conteúdo -->
        <div class="relative z-10 py-10 fade-in">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-start mb-4">
                    <a href="{{ route('corridas.create') }}"
                        class="mb-6 inline-block bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:scale-105 transform transition duration-300">
                        Nova Corrida
                    </a>
                </div>

                <div class="bg-white/90 dark:bg-gray-900/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-xl border border-gray-200/20">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <table class="min-w-full border-collapse text-sm md:text-base">
                            <thead class="bg-gray-100 dark:bg-gray-700/70">
                                <tr class="border-b border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Origem</th>
                                    <th class="px-4 py-2">Destino</th>
                                    <th class="px-4 py-2">Data</th>
                                    <th class="px-4 py-2">Preço</th>
                                    <th class="px-4 py-2">Motorista</th>
                                    <th class="px-4 py-2">Autor</th>
                                    <th class="px-4 py-2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($corridas as $corrida)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $corrida->id }}</td>
                                    <td class="px-4 py-2">{{ $corrida->origem_endereco ?? '--' }}</td>
                                    <td class="px-4 py-2">{{ $corrida->destino_endereco ?? '--' }}</td>
                                    <td class="px-4 py-2">{{ $corrida->agendado_para ?? '--' }}</td>
                                    <td class="px-4 py-2">{{ $corrida->preco ?? '--' }}</td>
                                    {{-- @foreach ($motoristas as $motorista ) --}}
                                    <td class="px-4 py-2">{{ $corrida->motorista->nome ?? 'Sem motorista' }}</td>
                                    {{-- @endforeach --}}

                                    <td>{{ $corrida->usuario->name }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('corridas.edit', $corrida) }}"
                                            class="text-blue-600 hover:underline"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('corridas.destroy', $corrida) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline ml-2">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        </div>
</x-app-layout>
