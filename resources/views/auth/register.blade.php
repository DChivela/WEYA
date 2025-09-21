<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="cell" :value="__('Cell')" />
            <x-text-input id="cell" class="block mt-1 w-full" type="text" name="cell" :value="old('cell')" required />
            <x-input-error :messages="$errors->get('cell')" class="mt-2" />
        </div>

        <!-- Perfil -->
        <div class="mt-4">
            <x-input-label for="perfil" :value="__('Perfil')" />
            <select id="perfil" name="perfil" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="turista" {{ old('perfil') == 'turista' ? 'selected' : '' }}>Turista</option>
                <option value="motorista" {{ old('perfil') == 'motorista' ? 'selected' : '' }}>Motorista</option>
                @auth
                @if(auth()->user()->perfil === 'admin')
                <option value="admin" {{ old('perfil', $user->perfil ?? '') == 'admin' ? 'selected' : '' }}>Administrador</option>
                @endif
                @endauth

            </select>
            <x-input-error :messages="$errors->get('perfil')" class="mt-2" />
        </div>


        <!-- Crédito -->
        <div class="mt-4">
            <x-input-label for="credito" :value="__('Crédito')" />
            <x-text-input id="credito" class="block mt-1 w-full" type="number" name="credito" :value="old('credito')" />
            <x-input-error :messages="$errors->get('credito')" class="mt-2" />
        </div>

        <!-- Meta -->
        <div class="mt-4">
            <x-input-label for="meta" :value="__('Meta')" />
            <x-text-input id="meta" class="block mt-1 w-full" type="text" name="meta" :value="old('meta')" />
            <x-input-error :messages="$errors->get('meta')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
