<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <img src="{{ asset('assets/logo/logo_192.png') }}"
                        alt="Logo"
                        class="block h-9 w-auto">--}}
                        <img src="{{ asset('assets/logo/Logo_Vakwetu.png') }}" class="block h-14 w-auto dark:hidden" alt="Logo claro">
                        <img src="{{ asset('assets/logo/Logo_Vakwetu.png') }}" class="hidden h-14 w-auto dark:block" alt="Logo escuro">

                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <x-nav-link :href="route('corridas.index')" :active="request()->routeIs('corridas.*')">
                    {{ __('Tours') }}
                </x-nav-link>
                @auth
                @if(auth()->user()->perfil === 'admin' || auth()->user()->perfil === 'motorista')
                <x-nav-link :href="route('motoristas.index')" :active="request()->routeIs('motoristas.*')">
                    {{ __('Motoristas') }}
                </x-nav-link>
                @endif
                @endauth
                <x-nav-link :href="route('pacotes.index')" :active="request()->routeIs('pacotes.*')">
                    {{ __('Pacotes') }}
                </x-nav-link>
                <x-nav-link :href="route('promocoes.index')" :active="request()->routeIs('promocoes.*')">
                    {{ __('Promoções') }}
                </x-nav-link>
                <x-nav-link :href="route('hoteis.index')" :active="request()->routeIs('hoteis.*')">
                    {{ __('Hóteis') }}
                </x-nav-link>
                <x-nav-link :href="route('restaurantes.index')" :active="request()->routeIs('restaurantes.*')">
                    {{ __('Restaurantes') }}
                </x-nav-link>
                <!-- Dentro de resources/views/layouts/navigation.blade.php -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Botão de alternar tema -->
                    <button id="theme-toggle"
                        class="p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Alternar tema
                    </button>
                </div>


            </div>
<!--
██████╗  ██████╗██╗  ██╗██╗██╗   ██╗███████╗██╗      █████╗
██╔══██╗██╔════╝██║  ██║██║██║   ██║██╔════╝██║     ██╔══██╗
██║  ██║██║     ███████║██║██║   ██║█████╗  ██║     ███████║
██║  ██║██║     ██╔══██║██║╚██╗ ██╔╝██╔══╝  ██║     ██╔══██║
██████╔╝╚██████╗██║  ██║██║ ╚████╔╝ ███████╗███████╗██║  ██║
╚═════╝  ╚═════╝╚═╝  ╚═╝╚═╝  ╚═══╝  ╚══════╝╚══════╝╚═╝  ╚═╝ -->

            <!-- Settings Dropdown -->
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

                        <!-- Authentication -->
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

            <!-- Hamburger -->
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

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
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

                <!-- Authentication -->
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
<!-- Caixa de interação do Assistente Turístico -->
<div id="ai-widget" style="position:fixed;right:20px;bottom:20px;width:320px;background:#fff;padding:12px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.12);z-index:9999;font-family:sans-serif;">
    <div style="font-weight:bold;margin-bottom:8px;">Assistente Turístico</div>

    <div id="ai-history" style="height:200px;overflow-y:auto;border:1px solid #ddd;padding:8px;border-radius:4px;background:#f9f9f9;"></div>

    <textarea id="ai-q" rows="3" style="width:100%;margin-top:8px;padding:6px;" placeholder="Escreve a tua pergunta aqui..."></textarea>
    <button id="ai-send" style="width:100%;margin-top:8px;">Perguntar</button>
</div>

<script>
    const historyDiv = document.getElementById('ai-history');
    const inputEl = document.getElementById('ai-q');
    const resDiv = historyDiv;


    document.getElementById('ai-send').addEventListener('click', async () => {
        const q = inputEl.value.trim();
        if (!q) return alert('Escreve a pergunta');

        // Adiciona pergunta ao histórico
        const userMsg = document.createElement('div');
        userMsg.style.fontWeight = 'bold';
        userMsg.style.color = '#094687';
        userMsg.style.marginBottom = '4px';
        userMsg.textContent = "Tu: " + q;
        historyDiv.appendChild(userMsg);

        // Mostra "A processar..." para a resposta
        const loadingMsg = document.createElement('div');
        loadingMsg.style.color = '#121f00';
        loadingMsg.style.marginBottom = '8px';
        loadingMsg.textContent = "Assistente: A processar...";
        historyDiv.appendChild(loadingMsg);
        historyDiv.scrollTop = historyDiv.scrollHeight;

        inputEl.value = '';

        try {
            const resp = await fetch('/ai/query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    q
                })
            });

            const data = await resp.json();

            loadingMsg.textContent = data && typeof data.answer === 'string' ?
                "Assistente: " + data.answer :
                "Erro: resposta inválida";

            historyDiv.scrollTop = historyDiv.scrollHeight;

        } catch (err) {
            loadingMsg.textContent = 'Erro ao contactar o servidor: ' + err.message;
            historyDiv.scrollTop = historyDiv.scrollHeight;
        }
    });
</script>

<script>
    const html = document.documentElement;
    const themeToggle = document.getElementById('theme-toggle');

    // Carregar preferência guardada
    if (localStorage.theme === 'dark') {
        html.classList.add('dark');
    } else if (localStorage.theme === 'light') {
        html.classList.remove('dark');
    }

    themeToggle.addEventListener('click', () => {
        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            html.classList.add('dark');
            localStorage.theme = 'dark';
        }
    });
</script>
