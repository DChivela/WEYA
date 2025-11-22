<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/driver_3.jpg');">

        <!-- Camada de desfoque e escurecimento -->
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>

        <!-- Cabeçalho -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Motoristas') }}
            </h2>
        </x-slot>

        <!-- Conteúdo -->
        <div class="relative z-10 py-10 fade-in">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Botão -->
                <a href="{{ route('motoristas.create') }}"
                    class="mb-6 inline-block bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold px-5 py-2 rounded-lg shadow-md hover:scale-105 transform transition duration-300">
                    Novo Motorista
                </a>

                <!-- Card principal -->
                <div class="bg-white/90 dark:bg-gray-900/80 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-xl border border-gray-200/20">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <table class="min-w-full border-collapse text-sm md:text-base">
                            <thead class="bg-gray-100 dark:bg-gray-700/70">
                                <tr class="border-b border-gray-300 dark:border-gray-600 text-gray-100 dark:text-gray-100">
                                    <th class="px-4 py-2 text-left">Foto</th>
                                    <th class="px-4 py-2 text-left">Nome</th>
                                    <th class="px-4 py-2 text-left">Telefone</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Carro</th>
                                    <th class="px-4 py-2 text-left">Placa</th>
                                    <th class="px-4 py-2 text-left">Idade</th>
                                    <th class="px-4 py-2 text-left">Avaliação</th>
                                    <th class="px-4 py-2 text-left">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($motoristas as $motorista)
                                <tr class="border-b hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-gray-800/50 transition text-white">
                                    <td class="px-4 py-2">
                                        @if($motorista->foto)
                                        <img src="{{ asset('storage/' . $motorista->foto) }}"
                                            alt="Foto do motorista"
                                            class="h-12 w-12 rounded-full object-cover ring-2 ring-blue-500/40">
                                        @else
                                        <span class="text-gray-500">Sem foto</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $motorista->nome }}</td>
                                    <td class="px-4 py-2">{{ $motorista->telefone }}</td>
                                    <td class="px-4 py-2">{{ $motorista->email }}</td>
                                    <td class="px-4 py-2">{{ $motorista->veiculo_marca }} {{ $motorista->veiculo_modelo }}</td>
                                    <td class="px-4 py-2">{{ $motorista->veiculo_placa }}</td>
                                    <td class="px-4 py-2">{{ $motorista->idade ? $motorista->idade . ' anos' : 'Não informado' }}</td>
                                    <td class="px-4 py-2">
                                        @if($motorista->avaliacao_media)
                                        @for ($i = 0; $i < $motorista->avaliacao_media; $i++)
                                            ⭐
                                            @endfor
                                            @else
                                            <span class="text-gray-500">Sem avaliação</span>
                                            @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('motoristas.show', $motorista) }}"
                                            class="text-green-600 hover:text-green-800 mx-1 transition"><i class="bi bi-eye"></i></a>

                                        @if(auth()->user()->perfil === 'admin')
                                        <a href="{{ route('motoristas.edit', $motorista) }}"
                                            class="text-blue-600 hover:text-blue-800 mx-1 transition"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('motoristas.destroy', $motorista) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 mx-1 transition"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-6">
                            {{ $motoristas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInTop {
                from {
                    opacity: 0;
                    transform: translateY(-30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in {
                animation: fadeIn 1.2s ease-out both;
            }

            .fade-in-top {
                animation: fadeInTop 1.2s ease-out both;
            }
        </style>
    </div>
</x-app-layout>
