<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes do Motorista
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

                <p><strong>Nome:</strong> {{ $motorista->nome }}</p>
                <p><strong>Telefone:</strong> {{ $motorista->telefone }}</p>
                <p><strong>Email:</strong> {{ $motorista->email }}</p>

                <div class="mt-4">
                    <a href="{{ route('motoristas.edit', $motorista) }}" class="text-blue-600 hover:underline">Editar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
