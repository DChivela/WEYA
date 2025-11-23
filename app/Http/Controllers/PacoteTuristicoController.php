<?php

namespace App\Http\Controllers;

use App\Models\PacoteTuristico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacoteTuristicoController extends Controller
{
    public function index()
    {
        $pacotes = PacoteTuristico::orderBy('created_at', 'desc')->paginate(15);
        return view('pacotes.index', compact('pacotes'));
    }

    public function create()
    {
        return view('pacotes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'preco'         => 'required|numeric|min:0',
            'duracao_dias'  => 'required|integer|min:1',
            'local_partida' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'itinerario'    => 'nullable|array',
            'incluido'    => 'nullable|array',
            'vagas'         => 'required|integer|min:1',
            'ativo'         => 'nullable|boolean',
            'foto' => 'nullable|image|max:4048',
        ]);

        // Garantir que "ativo" é boolean
        $validated['ativo'] = $request->has('ativo');

        if ($request->hasFile('foto')) {
            $fotosPaths = [];
            foreach ($request->file('foto') as $foto) {
                $fotosPaths[] = $foto->store('pacotes', 'public');
            }
            $validated['foto'] = $fotosPaths; // se for um campo JSON na tabela
        }

        PacoteTuristico::create($validated);

        return redirect()->route('pacotes.index')->with('success', 'Pacote criado com sucesso.');
    }

    public function show(PacoteTuristico $pacote)
    {
        return view('pacotes.show', compact('pacote'));
    }

    public function edit(PacoteTuristico $pacote)
    {
        return view('pacotes.edit', compact('pacote'));
    }

    public function update(Request $request, PacoteTuristico $pacote)
    {
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'preco'         => 'required|numeric|min:0',
            'duracao_dias'  => 'required|integer|min:1',
            'local_partida' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'itinerario'    => 'nullable|array',
            'incluido'    => 'nullable|array',
            'vagas'         => 'required|integer|min:1',
            'ativo'         => 'nullable|boolean',
            'foto' => 'nullable|image|max:5048',
        ]);
        if ($request->hasFile('foto')) {
            if ($pacote->foto) {
                Storage::delete('public/' . $pacote->foto);
            }

            $validated['foto'] = $request->file('foto')->store('pacotes', 'public');
        }

        $pacote->update($validated);

        return redirect()->route('pacotes.index')->with('success', 'Pacote atualizado com sucesso.');
    }

    public function destroy(PacoteTuristico $pacote)
    {
        if ($pacote->foto) {
            Storage::delete('public/' . $pacote->foto);
        }
        $pacote->delete(); // SoftDelete
        return redirect()->route('pacotes.index')->with('success', 'Pacote excluído com sucesso.');
    }
}
