{{-- Pacotes em destaque --}}
@if ($pacotesDestaque->count())
<div class="bg-gradient-to-r from-yellow-100 via-yellow-200 to-yellow-300 rounded-xl shadow-md p-4">
    <h3 class="text-xl font-bold text-yellow-800 mb-4">✨ Pacotes em Destaque</h3>
    <div class="flex overflow-x-auto space-x-4 scrollbar-hide">
        @foreach ($pacotesDestaque as $pacote)
        <div class="min-w-[250px] bg-white dark:bg-gray-900 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
            <a href="{{ route('pacotes.show', $pacote) }}">
                @if ($pacote->foto)
                <img src="{{ asset('storage/' . $pacote->foto) }}" class="w-full h-40 object-cover rounded-t-lg" alt="{{ $pacote->nome }}">
                @endif
                <div class="p-4">
                    <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-100">{{ $pacote->nome }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $pacote->destino }}</p>
                    <p class="text-green-600 font-bold mt-2">{{ number_format($pacote->preco, 2, ',', '.') }} Kz</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif
