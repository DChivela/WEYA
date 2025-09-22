<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Pacote Turístico
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('pacotes.update', $pacote) }}" method="POST">
                    @csrf @method('PUT')

                    @include('pacotes.partials.form', ['pacote' => $pacote])

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
