<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nova Corrida
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('corridas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Origem</label>
                        <input type="text" name="origem" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Destino</label>
                        <input type="text" name="destino" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Motorista</label>
                        <select name="motorista_id" class="w-full border rounded p-2">
                            @foreach($motoristas as $motorista)
                                <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
