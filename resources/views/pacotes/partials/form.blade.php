{{-- resources/views/pacotes/partials/form.blade.php --}}

<div class="mb-4">
    <x-input-label for="nome" value="Nome" />
    <x-text-input id="nome" name="nome" type="text" class="w-full"
                  value="{{ old('nome', $pacote->nome ?? '') }}" required />
    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
</div>

<div class="mb-4">
    <x-input-label for="descricao" value="Descrição" />
    <textarea id="descricao" name="descricao" class="w-full border rounded p-2"
              rows="4">{{ old('descricao', $pacote->descricao ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div>
        <x-input-label for="preco" value="Preço (Kz)" />
        <x-text-input id="preco" name="preco" type="number" step="0.01" min="0"
                      class="w-full"
                      value="{{ old('preco', $pacote->preco ?? '') }}" required />
        <x-input-error :messages="$errors->get('preco')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="duracao_dias" value="Duração (dias)" />
        <x-text-input id="duracao_dias" name="duracao_dias" type="number" min="1"
                      class="w-full"
                      value="{{ old('duracao_dias', $pacote->duracao_dias ?? '') }}" required />
        <x-input-error :messages="$errors->get('duracao_dias')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="vagas" value="Vagas" />
        <x-text-input id="vagas" name="vagas" type="number" min="1"
                      class="w-full"
                      value="{{ old('vagas', $pacote->vagas ?? '') }}" required />
        <x-input-error :messages="$errors->get('vagas')" class="mt-2" />
    </div>
</div>

<div class="mb-4">
    <x-input-label for="local_partida" value="Local de partida" />
    <x-text-input id="local_partida" name="local_partida" type="text" class="w-full"
                  value="{{ old('local_partida', $pacote->local_partida ?? '') }}" required />
    <x-input-error :messages="$errors->get('local_partida')" class="mt-2" />
</div>

{{-- Itinerário (array dinâmico) --}}
@php
    $itensItinerario = old('itinerario', $pacote->itinerario ?? []);
    if (!is_array($itensItinerario)) { $itensItinerario = []; }
@endphp

<div class="mb-4">
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
</div>

{{-- Ativo (checkbox) --}}
<div class="mb-4">
    <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="ativo" value="1"
               {{ old('ativo', $pacote->ativo ?? false) ? 'checked' : '' }}
               class="rounded border-gray-300">
        <span>Ativo</span>
    </label>
    <x-input-error :messages="$errors->get('ativo')" class="mt-2" />
</div>

{{-- Fotos do pacote --}}
<div class="mb-4">
    <x-input-label for="fotos" value="Fotos do Pacote" />
    <input type="file" id="fotos" name="fotos[]" multiple accept="image/*"
           class="w-full border rounded p-2">
    <small class="text-gray-500">Podes selecionar várias imagens (JPEG, PNG, até 2MB cada)</small>
    <x-input-error :messages="$errors->get('fotos')" class="mt-2" />
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('itinerario-wrapper');
    const addBtn = document.getElementById('add-etapa');

    function createRow(value = '') {
        const row = document.createElement('div');
        row.className = 'flex items-center gap-2';
        row.innerHTML = `
            <input type="text" name="itinerario[]" class="flex-1 border rounded p-2" placeholder="Ex.: Paragem no Miradouro" value="${value}">
            <button type="button" class="remove-etapa px-3 py-2 bg-red-100 text-red-700 rounded">Remover</button>
        `;
        return row;
    }

    addBtn?.addEventListener('click', () => {
        wrapper.appendChild(createRow(''));
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
});
</script>
@endpush
