<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Motoristas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <a href="{{ route('motoristas.create') }}" class="btn btn-primary mb-3">Novo Motorista</a>

                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b p-2">Nome</th>
                                <th class="border-b p-2">Telefone</th>
                                <th class="border-b p-2">Email</th>
                                <th class="border-b p-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($motoristas as $motorista)
                                <tr>
                                    <td class="border-b p-2">{{ $motorista->nome }}</td>
                                    <td class="border-b p-2">{{ $motorista->telefone }}</td>
                                    <td class="border-b p-2">{{ $motorista->email }}</td>
                                    <td class="border-b p-2">
                                        <a href="{{ route('motoristas.show', $motorista) }}" class="text-green-600 hover:underline">Ver</a> |
                                        <a href="{{ route('motoristas.edit', $motorista) }}" class="text-blue-600 hover:underline">Editar</a> |
                                        <form action="{{ route('motoristas.destroy', $motorista) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Excluir motorista?')" class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $motoristas->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
