<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            🌍 Bem-vindo ao Painel
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Banner de boas-vindas --}}
            <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 text-white rounded-xl shadow-lg p-8">
                <h3 class="text-3xl font-bold mb-2">Olá, {{ Auth::user()->name ?? 'Visitante' }} 👋</h3>
                <p class="text-lg">Explora a cidade com conforto e segurança. O teu motorista está a apenas um clique de distância.</p>
            </div>

            {{-- Cards de atalhos --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="text-blue-500 text-3xl mb-3">🚖</div>
                    <h4 class="font-semibold text-lg">Minhas Corridas</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Consulta o histórico e acompanha as tuas viagens.</p>
                    <a href="{{ route('corridas.index') }}" class="mt-3 inline-block text-blue-600 hover:underline">Ver corridas</a>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="text-green-500 text-3xl mb-3"><i class="bi bi-person-bounding-box"></i></div>
                    <h4 class="font-semibold text-lg">Motoristas</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Conhece os motoristas disponíveis e as suas avaliações.</p>
                    <a href="{{ route('motoristas.index') }}" class="mt-3 inline-block text-green-600 hover:underline">Ver motoristas</a>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-xl transition">
                    <div class="text-yellow-500 text-3xl mb-3">🗺️</div>
                    <h4 class="font-semibold text-lg">Descobre a Cidade</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Sugestões de pontos turísticos e locais imperdíveis.</p>
                    <a href="#" class="mt-3 inline-block text-yellow-600 hover:underline">Explorar</a>
                </div>
            </div>

            {{-- Mensagem final --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                <h4 class="text-xl font-semibold mb-2"><i class="bi bi-stars"></i> A tua jornada começa aqui ✨</h4>
                <p class="text-gray-600 dark:text-gray-400">Viaja com tranquilidade, descobre novos lugares e aproveita cada momento.</p>
            </div>

        </div>
    </div>
</x-app-layout>
