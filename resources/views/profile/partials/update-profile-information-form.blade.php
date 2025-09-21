<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Atualize os dados do seu perfil.') }}
        </p>
    </header>

    <form method @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Nome -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>


        <!-- Cell -->
        <div>
            <x-input-label for="cell" :value="__('Telefone')" />
            <x-text-input id="cell" name="cell" type="text" class="mt-1 block w-full"
                :value="old('cell', $user->cell)" required />
            <x-input-error class="mt-2" :messages="$errors->get('cell')" />
        </div>



        <!-- Perfil -->
        <div>
            <x-input-label for="perfil" :value="__('Perfil')" />
            <select id="perfil" name="perfil" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="turista" {{ $user->perfil == 'turista' ? 'selected' : '' }}>Turista</option>
                <option value="motorista" {{ $user->perfil == 'motorista' ? 'selected' : '' }}>Motorista</option>

                @if (auth()->user()->perfil === 'admin')
                <option value="admin" {{ $user->perfil == 'admin' ? 'selected' : '' }}>Administrador</option>
                @endif
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('perfil')" />
        </div>


        <!-- Crédito -->
        <div>
            <x-input-label for="credito" :value="__('Crédito')" />
            <x-text-input id="credito" name="credito" type="number" step="0.01" class="mt-1 block w-full"
                :value="old('credito', $user->credito)" />
            <x-input-error class="mt-2" :messages="$errors->get('credito')" />
        </div>

        <!-- Meta -->
        <div>
            <x-input-label for="meta" :value="__('Meta')" />
            <x-text-input id="meta" name="meta" type="text" class="mt-1 block w-full"
                :value="old('meta', $user->meta)" />
            <x-input-error class="mt-2" :messages="$errors->get('meta')" />
        </div>
        </div>

        <!-- Botão -->
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Salvo.') }}
            </p>
            @endif
        </div>
    </form>
</section>
