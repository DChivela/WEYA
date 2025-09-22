<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Motoristas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('motoristas.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Novo Motorista</a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <table class="min-w-full border-collapse">
                        <thead>
                            <tr class="border-b">
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
                            <tr class="border-b">
                                {{-- Foto --}}
                                <td class="px-4 py-2">
                                    @if($motorista->foto)
                                    <img src="{{ asset('storage/' . $motorista->foto) }}"
                                        alt="Foto do motorista"
                                        class="h-12 w-12 rounded-full object-cover">
                                    @else
                                    <span class="text-gray-500">Sem foto</span>
                                    @endif
                                </td>

                                {{-- Nome --}}
                                <td class="px-4 py-2">{{ $motorista->nome }}</td>

                                {{-- Telefone --}}
                                <td class="px-4 py-2">{{ $motorista->telefone }}</td>

                                {{-- Email --}}
                                <td class="px-4 py-2">{{ $motorista->email }}</td>

                                {{-- Carro --}}
                                <td class="px-4 py-2">
                                    {{ $motorista->veiculo_marca }} {{ $motorista->veiculo_modelo }}
                                </td>

                                {{-- Placa --}}
                                <td class="px-4 py-2">{{ $motorista->veiculo_placa }}</td>

                                {{-- Idade (calculada pelo accessor getIdadeAttribute) --}}
                                <td class="px-4 py-2">
                                    {{ $motorista->idade ? $motorista->idade . ' anos' : 'Não informado' }}
                                </td>

                                {{-- Avaliação em estrelas --}}
                                <td class="px-4 py-2">
                                    @if($motorista->avaliacao_media)
                                    @for ($i = 0; $i < $motorista->avaliacao_media; $i++)
                                        ⭐
                                        @endfor
                                        @else
                                        <span class="text-gray-500">Sem avaliação</span>
                                        @endif
                                </td>

                                {{-- Ações --}}
                                <td class="px-4 py-2">
                                    <a href="{{ route('motoristas.show', $motorista) }}"
                                    class="text-green-600 hover:underline"><i class="bi bi-eye"></i> </a>

                                    @if(auth()->user()->perfil === 'admin')
                                    <a href="{{ route('motoristas.edit', $motorista) }}"
                                        class="text-blue-600 hover:underline"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('motoristas.destroy', $motorista) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:underline ml-2">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Paginação --}}
                    <div class="mt-4">
                        {{ $motoristas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
