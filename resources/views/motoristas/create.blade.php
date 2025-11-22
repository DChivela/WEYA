<x-app-layout>
    <div class="relative min-h-screen flex flex-col bg-cover bg-center"
        style="background-image: url('/assets/img/driver_3.jpg');">

        <!-- Camada de desfoque e escurecimento -->
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Novo Motorista
            </h2>
        </x-slot>

        <div class="py-6 relative z-10 fade-in">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

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
                            <p class="text-lg md:text-sm text-red-700 dark:text-gray-100 opacity-90 italic font-bold">
                                Foto menor/igual a 2MB.
                            </p>
                        </div>

                        {{-- Data de nascimento --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Data de nascimento</label>
                            <input type="date" name="data_nascimento" class="w-full border rounded p-2">
                        </div>

                        {{-- Avaliação média (estrelas) --}}
                        {{-- --}}
                        <div class="mb-4" hidden>
                            <label class="block text-sm font-medium">Classificação</label>
                            <select name="avaliacao_media" class="w-full border rounded p-2">
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary bg-green-700 dark:bg-gray-100 from-blue-600 to-blue-500 text-white dark:text-gray-900 font-semibold px-5 py-2 rounded-lg shadow-md hover:scale-105 transform transition duration-300">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
