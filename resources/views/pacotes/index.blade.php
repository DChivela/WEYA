<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista de Pacotes Turísticos
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('pacotes.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Novo Pacote</a>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="p-2 text-left">Nome</th>
                            <th class="p-2">Preço</th>
                            <th class="p-2">Duração</th>
                            <th class="p-2">Ativo</th>
                            <th class="p-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacotes as $pacote)
                            <tr class="border-b">
                                <td class="p-2">{{ $pacote->nome }}</td>
                                <td class="p-2">{{ number_format($pacote->preco, 2, ',', '.') }} Kz</td>
                                <td class="p-2">{{ $pacote->duracao_dias }} dias</td>
                                <td class="p-2">{{ $pacote->ativo ? 'Sim' : 'Não' }}</td>
                                <td class="p-2 space-x-2">
                                    <a href="{{ route('pacotes.show', $pacote) }}" class="text-blue-600">Ver</a>
                                    @auth
                                    @if (auth()->user()->perfil === 'admin' )
                                    <a href="{{ route('pacotes.edit', $pacote) }}" class="text-yellow-600">Editar</a>
                                    <form action="{{ route('pacotes.destroy', $pacote) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza?')" class="text-red-600">Apagar</button>
                                    </form>
                                    @endif
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $pacotes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
