<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar Motorista
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('motoristas.update', $motorista) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- Nome --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nome</label>
                        <input type="text" name="nome" value="{{ old('nome', $motorista->nome) }}" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Telefone --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone', $motorista->telefone) }}" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $motorista->email) }}" class="w-full border rounded p-2">
                    </div>

                    {{-- CNH --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Número da CNH</label>
                        <input type="text" name="numero_cnh" value="{{ old('numero_cnh', $motorista->numero_cnh) }}" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Marca do carro --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Marca do carro</label>
                        <input type="text" name="veiculo_marca" value="{{ old('veiculo_marca', $motorista->veiculo_marca) }}" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Modelo do carro --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Modelo do carro</label>
                        <input type="text" name="veiculo_modelo" value="{{ old('veiculo_modelo', $motorista->veiculo_modelo) }}" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Placa do carro --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Placa do carro</label>
                        <input type="text" name="veiculo_placa" value="{{ old('veiculo_placa', $motorista->veiculo_placa) }}" class="w-full border rounded p-2" required>
                    </div>

                    {{-- Foto --}}

                    <div class="flex items-center space-x-6">
                        <div>
                            @if($motorista->foto)
                            <img src="{{ asset('storage/' . $motorista->foto) }}"
                                alt="Foto do motorista"
                                class="h-28 w-28 rounded-full object-cover border-2 border-gray-300 dark:border-gray-600">
                            @else
                            <div class="h-28 w-28 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                                Sem foto
                            </div>
                            @endif
                        </div>


                        {{-- Data de nascimento --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Data de nascimento</label>
                            <input type="date" name="data_nascimento" value="{{ old('data_nascimento', $motorista->data_nascimento) }}" class="w-full border rounded p-2">
                        </div>

                        {{-- Avaliação média --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Classificação</label>
                            <select name="avaliacao_media" class="w-full border rounded p-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $motorista->avaliacao_media == $i ? 'selected' : '' }}>
                                    {{ str_repeat('⭐', $i) }}
                                    </option>
                                    @endfor
                            </select>
                        </div>

                        {{-- Upload de nova foto --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Atualizar Foto</label>
                            <input type="file" name="foto" accept="image/*" class="w-full border rounded p-2">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
