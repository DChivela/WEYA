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
                :value="old('email', $user->email)" disabled title="Deve ter permissão para alterar o seu email" />
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
            <x-input-label for="perfil" :value="__('Tipo Conta')" />
            <select id="perfil" name="perfil" class="mt-1 block w-full ...">
                <option value="turista" {{ old('perfil', $user->perfil ?? '') == 'turista' ? 'selected' : '' }}>Turista</option>
                @auth
                @if(auth()->user()->perfil === 'admin')
                <option value="admin" {{ old('perfil', $user->perfil ?? '') == 'admin' ? 'selected' : '' }}>Administrador</option>
                @endif
                @endauth


            </select>
            <x-input-error class="mt-2" :messages="$errors->get('perfil')" />
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
        </section>
    </form>
</section>
