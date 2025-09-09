<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nova Corrida') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('corridas.store') }}">
                    @csrf

                    <!-- Origem -->
                    <div class="mb-4">
                        <x-input-label for="origem" :value="__('Origem')" />
                        <x-text-input id="origem" class="block mt-1 w-full" type="text" name="origem" readonly />
                    </div>

                    <!-- Destino -->
                    <div class="mb-4">
                        <x-input-label for="destino" :value="__('Destino')" />
                        <x-text-input id="destino" class="block mt-1 w-full" type="text" name="destino" readonly />
                    </div>

                    <!-- Observações -->
                    <div class="mb-4">
                        <x-input-label for="observacoes" :value="__('Observações')" />
                        <textarea id="observacoes" name="observacoes" class="w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-gray-200"></textarea>
                    </div>

                    <!-- Agendado para -->
                    <div class="mb-4">
                        <x-input-label for="agendado_para" :value="__('Agendado para')" />
                        <x-text-input id="agendado_para" class="block mt-1 w-full" type="datetime-local" name="agendado_para" />
                    </div>

                    <!-- Mapa -->
                    <div id="map" class="h-96 rounded-lg border"></div>

                    <!-- Botão -->
                    <div class="mt-6">
                        <x-primary-button>{{ __('Salvar Corrida') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([-11.2027, 17.8739], 6); // Angola default

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        function getAddress(lat, lng, callback) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.display_name) {
                        callback(data.display_name);
                    } else {
                        callback("Localização desconhecida");
                    }
                })
                .catch(() => callback("Erro ao buscar localização"));
        }

        // Localização atual
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                map.setView([lat, lng], 15);
                L.marker([lat, lng]).addTo(map).bindPopup("Origem").openPopup();

                getAddress(lat, lng, function (endereco) {
                    document.getElementById('origem').value = endereco;
                });
            }, function () {
                map.setView([-11.2027, 17.8739], 6); // fallback Angola
            });
        }

        // Clique para destino
        map.on("click", function (e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (window.destinoMarker) {
                map.removeLayer(window.destinoMarker);
            }

            window.destinoMarker = L.marker([lat, lng]).addTo(map).bindPopup("Destino").openPopup();

            getAddress(lat, lng, function (endereco) {
                document.getElementById('destino').value = endereco;
            });
        });
    });
    </script>
    @endpush
</x-app-layout>
