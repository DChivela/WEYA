<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Corrida') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form method="POST" action="{{ route('corridas.update', $corrida) }}">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label>Origem</label>
                            <input type="text" name="origem" value="{{ $corrida->origem_endereco }}" class=" block mt-1 w-full" required>
                        </div>
                        <div class="mb-3">
                            <label>Destino</label>
                            <input type="text" name="destino" value="{{ $corrida->destino_endereco }}" class="block mt-1 w-full" required>
                        </div>
                        <div class="mb-3">
                            <label>Preço</label>
                            <input type="number" step="0.01" name="preco" value="{{ $corrida->preco }}" class="form-control block mt-1 w-full" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>

</x-app-layout>
