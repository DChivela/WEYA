<x-app-layout>
    <div class="relative min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('/assets/img/promotion_03.jpg');">
        <!-- camada de escurecimento suave -->
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Promoções') }}
            </h2>
        </x-slot>
        <!-- conteúdo -->
        <div class="relative z-10 text-center fade-in">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white tracking-wide mb-4 animate-pulse">
                Sem Promoções!
            </h1>
            <p class="text-lg md:text-xl text-gray-200 opacity-90 font-light italic">
                Sem promoções no momento.
            </p>
        </div>

        <style>
            @keyframes pulse {

                0%,
                100% {
                    opacity: 0.7;
                    text-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
                }

                50% {
                    opacity: 1;
                    text-shadow: 0 0 25px rgba(255, 255, 255, 0.9);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-pulse {
                animation: pulse 3s ease-in-out infinite;
            }

            .fade-in {
                animation: fadeIn 1.5s ease-out both;
            }
        </style>
    </div>
</x-app-layout>
