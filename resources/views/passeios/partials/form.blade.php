{{-- resources/views/passeios/partials/form.blade.php --}}

<div class="mb-4">
    <x-input-label for="nome" value="Nome" />
    <x-text-input id="nome" name="nome" type="text" class="w-full"
        value="{{ old('nome', $passeio->nome ?? '') }}" required />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="descricao" value="Descrição" />
    <textarea id="descricao" name="descricao" class="w-full border rounded p-2"
        rows="4">{{ old('descricao', $passeio->descricao ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
</div>



<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    {{--<div>
        <x-input-label for="preco" value="Preço (Kz)" />
        <x-text-input id="preco" name="preco" type="number" step="0.01" min="0"
            class="w-full"
            value="{{ old('preco', $passeio->preco ?? '') }}" required />
    <x-input-error :messages="$errors->get('preco')" class="mt-2" />
</div>--}}

<div>
    <x-input-label for="duracao_horas" value="Duração (horas)" />
    <x-text-input id="duracao_horas" name="duracao_horas" type="number" min="1"
        class="w-full"
        value="{{ old('duracao_horas', $passeio->duracao_horas ?? '') }}" required />
    <x-input-error :messages="$errors->get('duracao_horas')" class="mt-2" />
</div>

<div>
    <x-input-label for="vagas" value="Vagas" />
    <x-text-input id="vagas" name="vagas" type="number" min="1"
        class="w-full"
        value="{{ old('vagas', $passeio->vagas ?? '') }}" required />
    <x-input-error :messages="$errors->get('vagas')" class="mt-2" />
</div>
</div>

<div class="mb-4">
    <x-input-label for="historia" value="História do Lugar" />
    <textarea id="historia" name="historia" class="w-full border rounded p-2"
        rows="4">{{ old('historia', $passeio->historia ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('historia')" class="mt-2" />
</div>
<div class="mb-4">
    <x-input-label for="local_partida" value="Local de partida" />
    <x-text-input id="local_partida" name="local_partida" type="text" class="w-full"
        value="{{ old('local_partida', $passeio->local_partida ?? '') }}" required />
    <x-input-error :messages="$errors->get('local_partida')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="destino" value="Local de destino" />
    <x-text-input id="destino" name="destino" type="text" class="w-full"
        value="{{ old('destino', $passeio->destino ?? '') }}" required />
    <x-input-error :messages="$errors->get('destino')" class="mt-2" />
</div>

{{-- Itinerário (array dinâmico)
@php
$itensItinerario = old('itinerario', $passeio->itinerario ?? []);
if (!is_array($itensItinerario)) { $itensItinerario = []; }
@endphp--}}

{{--<div class="mb-4">
    <x-input-label value="Itinerário (etapas)" />
    <div id="itinerario-wrapper" class="space-y-2">
        @forelse($itensItinerario as $i => $etapa)
        <div class="flex items-center gap-2">
            <input type="text" name="itinerario[]" class="flex-1 border rounded p-2"
                value="{{ $etapa }}" placeholder="Ex.: Visita às quedas da Tundavala" />
<button type="button" class="remove-etapa px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
</div>
@empty
<div class="flex items-center gap-2">
    <input type="text" name="itinerario[]" class="flex-1 border rounded p-2"
        placeholder="Ex.: Visita às quedas da Tundavala" />
    <button type="button" class="remove-etapa px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
</div>
@endforelse
</div>
<div class="mt-2">
    <button type="button" id="add-etapa" class="px-4 py-2 bg-gray-200 rounded">Adicionar etapa</button>
</div>
<x-input-error :messages="$errors->get('itinerario')" class="mt-2" />
</div>--}}



{{-- Destacar (checkbox). Precisamos do campo hidden com o valor 0 (zero) para enviar o valor quando for retirado do destaque --}}
{{--<div class="mb-4">
    <label class="inline-flex items-center gap-2">
        <input type="hidden" name="destaque" value="0">
        <input type="checkbox" name="destaque" value="1"
            {{ old('destaque', $passeio->destaque ?? false) ? 'checked' : '' }}
class="rounded border-gray-300">
<span>Destacar</span>
</label>
<x-input-error :messages="$errors->get('destaque')" class="mt-2" />
</div>--}}

{{-- Atividades Incuídas (array dinâmico) --}}
@php
$itensAtividadess = old('atividades', $passeio->atividades ?? []);
if (!is_array($itensAtividadess)) { $itensAtividadess = []; }
@endphp

<div class="mb-4">
    <x-input-label value="Atividades à incluir" />
    <div id="atividades-wrapper" class="space-y-2">
        @forelse($itensAtividadess as $i => $etapas)
        <div class="flex items-center gap-2">
            <input type="text" name="atividades[]" class="flex-1 border rounded p-2"
                value="{{ $etapas }}" placeholder="Ex.: Observação de paisagem" />
            <button type="button" class="remove-etapa-atividades px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        </div>
        @empty
        <div class="flex items-center gap-2">
            <input type="text" name="atividades[]" class="flex-1 border rounded p-2"
                placeholder="Ex.: Fotografias" />
            <button type="button" class="remove-etapa-atividades px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        </div>
        @endforelse
    </div>
    <div class="mt-2">
        <button type="button" id="add-etapa-atividade" class="px-4 py-2 bg-gray-200 rounded">Adicionar atividade</button>
    </div>
    <x-input-error :messages="$errors->get('atividades')" class="mt-2" />
</div>

{{-- Ativo (checkbox). Precisamos do campo hidden com o valor 0 (zero) para enviar o valor quando for retirado de ativo--}}
<div class="mb-4">
    <label class="inline-flex items-center gap-2">
        <input type="hidden" name="ativo" value="0">
        <input type="checkbox" name="ativo" value="1"
            {{ old('ativo', $passeio->ativo ?? false) ? 'checked' : '' }}
            class="rounded border-gray-300">
        <span>Ativo</span>
    </label>
    <x-input-error :messages="$errors->get('ativo')" class="mt-2" />
</div>

{{-- Dicas para o user (array dinâmico) --}}
@php
$Dicas = old('atividades', $passeio->dicas_user ?? []);
if (!is_array($Dicas)) { $Dicas = []; }
@endphp

<div class="mb-4">
    <x-input-label value="Dicas para o usuário" />
    <div id="dicas-wrapper" class="space-y-2">
        @forelse($Dicas as $i => $dicas)
        <div class="flex items-center gap-2">
            <input type="text" name="dicas_user[]" class="flex-1 border rounded p-2"
                value="{{ $dicas }}" placeholder="Ex.: Excelente para fotografia - levar câmara profissional" />
            <button type="button" class="remove-dica px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        </div>
        @empty
        <div class="flex items-center gap-2">
            <input type="text" name="dicas_user[]" class="flex-1 border rounded p-2"
                placeholder="Ex.: Observação de paisagem" />
            <button type="button" class="remove-dica px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        </div>
        @endforelse
    </div>
    <div class="mt-2">
        <button type="button" id="add-dica" class="px-4 py-2 bg-gray-200 rounded">Adicionar dica</button>
    </div>
    <x-input-error :messages="$errors->get('dicas_user')" class="mt-2" />
</div>

{{-- Fotos do passeio --}}
<div class="mb-4">
    <label class="block text-sm font-medium">Foto</label>
    <input type="file" name="foto" class="w-full border rounded p-2" accept="image/*">
    <p class="text-lg md:text-sm text-red-700 dark:text-gray-100 opacity-90 italic font-bold">
        Foto menor/igual a 2MB.
    </p>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('itinerario-wrapper');
        const atividades_wrapper = document.getElementById('atividades-wrapper');
        const dicas_wrapper = document.getElementById('dicas-wrapper');
        const addBtn = document.getElementById('add-etapa');
        const addBtnAtividade = document.getElementById('add-etapa-atividade');
        const addBtnDica = document.getElementById('add-dica');

        function createRow(value = '') {
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2';
            row.innerHTML = `
            <input type="text" name="itinerario[]" class="flex-1 border rounded p-2" placeholder="Ex.: Paragem ao Miradouro" value="${value}">
            <button type="button" class="remove-etapa px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        `;
            return row;
        }

        function createRowAtividade(value = '') {
            const rowInclu = document.createElement('div');
            rowInclu.className = 'flex items-center gap-2';
            rowInclu.innerHTML = `
            <input type="text" name="atividades[]" class="flex-1 border rounded p-2" placeholder="Ex.: Refeições incluídas" value="${value}">
            <button type="button" class="remove-etapa-atividades px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        `;
            return rowInclu;
        }

        function createRowDicas(value = '') {
            const rowDica = document.createElement('div');
            rowDica.className = 'flex items-center gap-2';
            rowDica.innerHTML = `
            <input type="text" name="dicas_user[]" class="flex-1 border rounded p-2" placeholder="Ex.: Melhor visitado durante a manhã ou final da tarde" value="${value}">
            <button type="button" class="remove-dica px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        `;
            return rowDica;
        }

        //Bpotão para add etapas
        addBtn?.addEventListener('click', () => {
            wrapper.appendChild(createRow(''));
        });

        //Botão para add itens incluídos
        addBtnAtividade?.addEventListener('click', () => {
            atividades_wrapper.appendChild(createRowAtividade(''));
        });

        //Botão para add dicas
        addBtnDica?.addEventListener('click', () => {
            dicas_wrapper.appendChild(createRowDicas(''));
        });

        wrapper.addEventListener('click', (e) => {
            if (e.target?.classList.contains('remove-etapa')) {
                const row = e.target.closest('.flex.items-center');
                // Se ficar sem nenhuma linha, mantém pelo menos uma
                if (wrapper.children.length > 1) {
                    row.remove();
                } else {
                    row.querySelector('input').value = '';
                }
            }
        });

        atividades_wrapper.addEventListener('click', (e) => {
            if (e.target?.classList.contains('remove-etapa-atividades')) {
                const rowInclu = e.target.closest('.flex.items-center');
                // Se ficar sem nenhuma linha, mantém pelo menos uma
                if (atividades_wrapper.children.length > 1) {
                    rowInclu.remove();
                } else {
                    rowInclu.querySelector('input').value = '';
                }
            }
        });

        //Função para remover dicas
        dicas_wrapper.addEventListener('click', (e) => {
            if (e.target?.classList.contains('remove-dica')) {
                const rowDica = e.target.closest('.flex.items-center');
                // Se ficar sem nenhuma linha, mantém pelo menos uma
                if (dicas_wrapper.children.length > 1) {
                    rowDica.remove();
                } else {
                    rowDica.querySelector('input').value = '';
                }
            }
        });
    });
</script>
@endpush
