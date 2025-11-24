<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    {{-- Primary Navigation Menu --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <img src="{{ asset('assets/logo/logo_192.png') }}"
                        alt="Logo"
                        class="block h-9 w-auto">--}}
                        <img src="{{ asset('assets/logo/Logo_Vakwetu.png') }}" class="block h-14 w-auto dark:hidden" alt="Logo claro">
                        <img src="{{ asset('assets/logo/Logo_Vakwetu.png') }}" class="hidden h-14 w-auto dark:block" alt="Logo escuro">

                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                {{--<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('corridas.index')" :active="request()->routeIs('corridas.*')">
                        {{ __('Tours') }}
                </x-nav-link>
            </div>--}}

            @auth
            @if(auth()->user()->perfil === 'admin')
            <x-nav-link :href="route('passeios.index')" :active="request()->routeIs('passeios.*')">
                {{ __('Tours') }}
            </x-nav-link>
            @else
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('passeios.tours')" :active="request()->routeIs('passeios.tours')">
                    {{ __('Tours') }}
                </x-nav-link>
            </div>
            @endif
            @endauth
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @auth
                @if(auth()->user()->perfil === 'admin' || auth()->user()->perfil === 'motorista')
                <x-nav-link :href="route('motoristas.index')" :active="request()->routeIs('motoristas.*')">
                    {{ __('Motoristas') }}
                </x-nav-link>
                @endif
                @endauth
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('pacotes.index')" :active="request()->routeIs('pacotes.*')">
                    {{ __('Pacotes') }}
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('promocoes.index')" :active="request()->routeIs('promocoes.*')">
                    {{ __('Promoções') }}
                </x-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('hoteis.index')" :active="request()->routeIs('hoteis.*')">
                    {{ __('Hóteis') }}
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('restaurantes.index')" :active="request()->routeIs('restaurantes.*')">
                    {{ __('Restaurantes') }}
                </x-nav-link>
            </div>
            {{-- Dentro de resources/views/layouts/navigation.blade.php --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- Botão de alternar tema --}}
                <button id="theme-toggle"
                    class="p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Alternar tema
                </button>
            </div>


        </div>


        {{-- Settings Dropdown --}}
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-dropdown-link>

                    {{-- Authentication --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        {{-- Hamburger --}}
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    </div>

    {{-- Menu de Navegação Responsivo --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        {{--<div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('corridas.index')" :active="request()->routeIs('corridas.*')">
                {{ __('Tours') }}
        </x-responsive-nav-link>
    </div>--}}
{{--    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('passeios.index')" :active="request()->routeIs('passeios.*')">
            {{ __('Tours') }}
        </x-responsive-nav-link>
    </div>
--}}
    @auth
    @if(auth()->user()->perfil != 'admin')
    <x-responsive-nav-link :href="route('passeios.tours')" :active="request()->routeIs('passeios.tours')">
        {{ __('Tours') }}
    </x-responsive-nav-link>
    @else
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-responsive-nav-link :href="route('passeios.index')" :active="request()->routeIs('passeios.*')">
            {{ __('Tours') }}
        </x-responsive-nav-link>
    </div>
    @endif
    @endauth

    @auth
    @if(auth()->user()->perfil === 'admin' || auth()->user()->perfil === 'motorista')
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('motoristas.index')" :active="request()->routeIs('motoristas.*')">
            {{ __('Motoristas') }}
        </x-responsive-nav-link>
    </div>
    @endif
    @endauth

    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('pacotes.index')" :active="request()->routeIs('pacotes.*')">
            {{ __('Pacotes') }}
        </x-responsive-nav-link>
    </div>

    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('promocoes.index')" :active="request()->routeIs('promocoes.*')">
            {{ __('Promoções') }}
        </x-responsive-nav-link>
    </div>

    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('hoteis.index')" :active="request()->routeIs('hoteis.*')">
            {{ __('Hóteis') }}
        </x-responsive-nav-link>
    </div>

    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('restaurantes.index')" :active="request()->routeIs('restaurantes.*')">
            {{ __('Restaurantes') }}
        </x-responsive-nav-link>
    </div>


    {{-- Opções de Configurações da Responsividade --}}
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
        <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <button id="theme-toggle"
                class="p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Alternar tema
            </button>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            {{-- Authentication --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
    </div>
</nav>


{{-- Caixa de interação do Assistente Turístico (com toggle minimizar) --}}
<div id="ai-widget"
    style="position:fixed;right:20px;bottom:20px;width:320px;background:#fff;padding:12px;border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.14);z-index:9999;font-family:sans-serif;transition:all .25s ease;">
    {{-- Header com título + botão minimizar --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
        <div style="font-weight:700;">Assistente Turístico</div>

        <div style="display:flex;gap:8px;align-items:center;">
            {{-- Botão minimizar/fechar para desktop --}}
            <button id="ai-toggle" aria-expanded="true"
                style="background:transparent;border:none;cursor:pointer;padding:6px;border-radius:6px;"
                title="Minimizar/Restaurar">
                {{-- simples ícone (pode trocar por svg) --}}
                <svg id="ai-toggle-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden>
                    <path d="M6 9L12 3L18 9" stroke="#374151" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 15L12 21L18 15" stroke="#374151" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Conteúdo principal (history + input) --}}
    <div id="ai-body">
        <div id="ai-history"
            style="height:200px;overflow-y:auto;border:1px solid #eee;padding:10px;border-radius:6px;background:#fbfbfb;"></div>

        <textarea id="ai-q" rows="3" style="width:100%;margin-top:8px;padding:8px;border-radius:6px;border:1px solid #e6e6e6;"
            placeholder="Escreve a tua pergunta aqui..."></textarea>
        <button id="ai-send" style="width:100%;margin-top:8px;padding:8px;border-radius:6px;background:#0b6fbd;color:#fff;border:none;cursor:pointer;">
            Perguntar
        </button>
    </div>
</div>

{{-- Botão compacto que aparece quando o widget está minimizado --}}
{{-- <button id="ai-mini" aria-hidden="true" title="Pergunte qualquer coisa ao seu Assistente"
        style="position:fixed;right:20px;bottom:20px;width:56px;height:56px;border-radius:999px;border:none;display:none;
               box-shadow:0 8px 24px rgba(0,0,0,0.18);z-index:9998;padding:0;cursor:pointer;background:#fff;overflow:hidden;">
    {{-- usa a tua imagem local como ícone; path: /mnt/data/375d46ee-5fd4-4a9c-b4fb-701f27b064da.png
    <img src="{{ asset('assets/logo/Logo_Vakwetu.png') }}" alt="Assistente" style="width:100%;height:100%;object-fit:cover;">
</button>--}}

{{-- MINI BOTÃO Quando compacto --}}
<button id="ai-mini" aria-hidden="true" class="ai-mini" type="button">
    <img src="{{ asset('assets/logo/Logo_Vakwetu.png') }}" alt="Assistente" class="ai-mini__img">
    {{-- Title overlay (visible apenas no modo 'title') --}}
    <div class="ai-mini__title">O seu assistente!</div>

    {{-- seta apontando para o widget (SVG) --}}
    <svg class="ai-mini__arrow" viewBox="0 0 24 24" width="34" height="24" aria-hidden>
        <path d="M12 2 L12 18" stroke="rgba(11,111,189,0.95)" stroke-width="1.6" stroke-linecap="round" />
        <path d="M5 11 L12 18 L19 11" fill="rgba(11,111,189,0.95)"></path>
    </svg>

    {{-- pulsação (visível apenas no modo 'pulse') --}}
    <span class="ai-mini__pulse ai-mini__pulse--one"></span>
    <span class="ai-mini__pulse ai-mini__pulse--two"></span>
</button>

{{-- Script do Assistente Turístico --}}
<script src={{ asset("../js/navigation.js") }}></script>

{{-- Responsável pelo toggle do tema claro/escuro --}}
<script src={{ asset("../js/alterar_tema.js") }}></script>
