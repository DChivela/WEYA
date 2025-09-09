<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Corridas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('corridas.create') }}" class="btn btn-primary mb-3">Nova Corrida</a>

                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b p-2">Origem</th>
                                <th class="border-b p-2">Destino</th>
                                <th class="border-b p-2">Motorista</th>
                                <th class="border-b p-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($corridas as $corrida)
                                <tr>
                                    <td class="border-b p-2">{{ $corrida->origem }}</td>
                                    <td class="border-b p-2">{{ $corrida->destino }}</td>
                                    <td class="border-b p-2">{{ $corrida->motorista->nome ?? '—' }}</td>
                                    <td class="border-b p-2">
                                        <a href="{{ route('corridas.show', $corrida) }}" class="text-green-600 hover:underline">Ver</a> |
                                        <a href="{{ route('corridas.edit', $corrida) }}" class="text-blue-600 hover:underline">Editar</a> |
                                        <form action="{{ route('corridas.destroy', $corrida) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Excluir?')" class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $corridas->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
