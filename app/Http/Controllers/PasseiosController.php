<?php

namespace App\Http\Controllers;

use App\Models\Passeio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PasseiosController extends Controller
{
    public function index()
    {
        $passeios = Passeio::orderBy('created_at', 'desc')->paginate(15);
        return view('passeios.index', compact('passeios'));
    }

    public function tours()
    {
        $passeiosTour = Passeio::orderBy('created_at', 'desc')->paginate(15);
        return view('passeios.tours', compact('passeiosTour'));
    }

    public function create()
    {
        return view('passeios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'historia'     => 'nullable|string',
            //'preco'         => 'required|numeric|min:0',
            //'destaque'         => 'nullable|boolean',
            'duracao_horas'  => 'required|integer|min:1',
            'local_partida' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            //'itinerario'    => 'nullable|array',
            'atividades'    => 'nullable|array',
            'dicas_user'    => 'nullable|array',
            'vagas'         => 'required|integer|min:1',
            'ativo'         => 'nullable|boolean',
            'foto' => 'nullable|image|max:4048',
        ]);

        // Garantir que "ativo" é boolean
        $validated['ativo'] = $request->has('ativo');

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('passeios', 'public');
        }

        Passeio::create($validated);

        return redirect()->route('passeios.index')->with('success', 'Passeio criado com sucesso.');
    }

    public function show(Passeio $passeio)
    {
        return view('passeios.show', compact('passeio'));
    }

    public function edit(Passeio $passeio)
    {
        return view('passeios.edit', compact('passeio'));
    }

    public function update(Request $request, Passeio $passeio)
    {
        $validated = $request->validate([
            'nome'          => 'required|string|max:255',
            'descricao'     => 'nullable|string',
            'historia'     => 'nullable|string',
            //'preco'         => 'required|numeric|min:0',
            //'destaque'         => 'nullable|boolean',
            'duracao_horas'  => 'required|integer|min:1',
            'local_partida' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            //'itinerario'    => 'nullable|array',
            'atividades'    => 'nullable|array',
            'vagas'         => 'required|integer|min:1',
            'ativo'         => 'nullable|boolean',
            'foto' => 'nullable|image|max:5048',
        ]);

        //Saçvar apenas uma única imagem
        if ($request->hasFile('foto')) {
            if ($passeio->foto) {
                Storage::delete('public/' . $passeio->foto);
            }

            $validated['foto'] = $request->file('foto')->store('passeios', 'public');
        }

        $passeio->update($validated);

        return redirect()->route('passeios.index')->with('success', 'passeio atualizado com sucesso.');
    }

    public function destroy(Passeio $passeio)
    {
        if ($passeio->foto) {
            Storage::delete('public/' . $passeio->foto);
        }
        $passeio->delete(); // SoftDelete
        return redirect()->route('passeios.index')->with('success', 'passeio excluído com sucesso.');
    }
}
