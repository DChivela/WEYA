<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Novo Motorista
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('motoristas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nome --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nome</label>
                        <input type="text" name="nome" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Telefone --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Telefone</label>
                        <input type="text" name="telefone" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2">
                    </div>

                    {{-- CNH --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Número da CNH</label>
                        <input type="text" name="numero_cnh" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Marca do carro --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Marca do carro</label>
                        <input type="text" name="veiculo_marca" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Modelo do carro --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Modelo do carro</label>
                        <input type="text" name="veiculo_modelo" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Placa do carro --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Placa do carro</label>
                        <input type="text" name="veiculo_placa" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Foto --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Foto</label>
                        <input type="file" name="foto" class="w-full border rounded p-2" accept="image/*">
                    </div>

                    {{-- Data de nascimento --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Data de nascimento</label>
                        <input type="date" name="data_nascimento" class="w-full border rounded p-2">
                    </div>

                    {{-- Avaliação média (estrelas) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Classificação</label>
                        <select name="avaliacao_media" class="w-full border rounded p-2">
                            <option value="1">⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
