<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Corridas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('corridas.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Nova Corrida
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Origem</th>
                            <th class="px-4 py-2">Destino</th>
                            <th class="px-4 py-2">Data</th>
                            <th class="px-4 py-2">Autor</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($corridas as $corrida)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $corrida->id }}</td>
                                <td class="px-4 py-2">{{ $corrida->origem }}</td>
                                <td class="px-4 py-2">{{ $corrida->destino }}</td>
                                <td class="px-4 py-2">{{ $corrida->data }}</td>
                                <td>{{ $corrida->usuario->name }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('corridas.edit', $corrida) }}"
                                       class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('corridas.destroy', $corrida) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2">
                                            Excluir
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
</x-app-layout>
