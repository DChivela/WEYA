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

                    <!-- Tipo -->
                    <div class="mb-4">
                        <x-input-label for="tipo" :value="'Tipo da Corrida'" />
                        <select id="tipo" name="tipo" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="regular">Regular</option>
                            <option value="pacote">Pacote</option>
                            <option value="compartilhada">Compartilhada</option>
                        </select>
                        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                    </div>

                    <!-- Origem -->
                    <x-input-label for="origem" :value="'Endereço de Origem'" />
                    <x-text-input id="origem" class="block mt-1 w-full" type="text" name="origem_endereco" readonly />
                    <input type="hidden" id="origem_lat" name="origem_lat">
                    <input type="hidden" id="origem_lng" name="origem_lng">

                    <!-- Destino -->
                    <x-input-label for="destino" :value="'Endereço de Destino'" />
                    <x-text-input id="destino" class="block mt-1 w-full" type="text" name="destino_endereco" readonly />
                    <input type="hidden" id="destino_lat" name="destino_lat">
                    <input type="hidden" id="destino_lng" name="destino_lng">


                    <!-- Motorista -->
                    <div class="mb-4">
                        <x-input-label for="motorista_id" :value="'Motorista'" />
                        <select id="motorista_id" name="motorista_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            <option value="">Selecione um motorista</option>
                            @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('motorista_id')" class="mt-2" />
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

                    <!-- Preview -->
                    <div class="alert alert-info d-none" id="preview">
                        <strong>Resumo da Corrida:</strong><br>
                        Distância: <span id="preview_distancia"></span> km<br>
                        Duração: <span id="preview_duracao"></span> min<br>
                        Preço: <span id="preview_preco"></span> AOA
                    </div>

                    <input type="hidden" name="distancia_km" id="distancia_km">
                    <input type="hidden" name="duracao_segundos" id="duracao_segundos">
                    <input type="hidden" name="preco" id="preco">
                    <input type="hidden" name="tarifa_base" value="500">
                    <input type="hidden" name="tarifa_km" value="150">
                    <input type="hidden" name="tarifa_minuto" value="50">

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
        document.addEventListener("DOMContentLoaded", function() {
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
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;

                    map.setView([lat, lng], 15);
                    L.marker([lat, lng]).addTo(map).bindPopup("Origem").openPopup();

                    document.getElementById('origem_lat').value = lat;
                    document.getElementById('origem_lng').value = lng;

                    getAddress(lat, lng, function(endereco) {
                        document.getElementById('origem').value = endereco;
                    });
                }, function() {
                    map.setView([-11.2027, 17.8739], 6); // fallback Angola
                });
            }

            // Clique para destino
            map.on("click", function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                if (window.destinoMarker) {
                    map.removeLayer(window.destinoMarker);
                }

                window.destinoMarker = L.marker([lat, lng]).addTo(map).bindPopup("Destino").openPopup();

                document.getElementById('destino_lat').value = lat;
                document.getElementById('destino_lng').value = lng;

                getAddress(lat, lng, function(endereco) {
                    document.getElementById('destino').value = endereco;
                });
            });

            function toRad(value) {
                return value * Math.PI / 180;
            }

            function haversine(lat1, lon1, lat2, lon2) {
                const R = 6371; // km
                const dLat = toRad(lat2 - lat1);
                const dLon = toRad(lon2 - lon1);
                const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }

            function calcularPreview() {
                const lat1 = parseFloat(document.getElementById('origem_lat').value);
                const lon1 = parseFloat(document.getElementById('origem_lng').value);
                const lat2 = parseFloat(document.getElementById('destino_lat').value);
                const lon2 = parseFloat(document.getElementById('destino_lng').value);

                if (!lat1 || !lon1 || !lat2 || !lon2) return;

                const distanciaKm = haversine(lat1, lon1, lat2, lon2);
                const duracaoSegundos = (distanciaKm / 40) * 3600; // média 40 km/h
                const duracaoMin = Math.round(duracaoSegundos / 60);

                const tarifaBase = 500;
                const tarifaKm = 150;
                const tarifaMinuto = 50;

                const preco = tarifaBase + (distanciaKm * tarifaKm) + (duracaoMin * tarifaMinuto);

                document.getElementById('preview').classList.remove('d-none');
                document.getElementById('preview_distancia').innerText = distanciaKm.toFixed(2);
                document.getElementById('preview_duracao').innerText = duracaoMin;
                document.getElementById('preview_preco').innerText = Math.round(preco);
            }

            // ⚡ Atualiza preview quando os inputs de coordenadas mudam
            document.getElementById('origem_lat').addEventListener('change', calcularPreview);
            document.getElementById('origem_lng').addEventListener('change', calcularPreview);
            document.getElementById('destino_lat').addEventListener('change', calcularPreview);
            document.getElementById('destino_lng').addEventListener('change', calcularPreview);

        });
    </script>
    @endpush
</x-app-layout>
