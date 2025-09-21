<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = Motorista::paginate(15);
        return view('motoristas.index', compact('motoristas'));
    }

    public function create()
    {
        return view('motoristas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'numero_cnh' => 'required|string|max:50',
            'veiculo_marca' => 'required|string|max:100',
            'veiculo_modelo' => 'required|string|max:100',
            'veiculo_placa' => 'required|string|max:20',
            'data_nascimento' => 'nullable|date',
            'avaliacao_media' => 'nullable|integer|min:1|max:5',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('motoristas', 'public');
        }

        Motorista::create($validated);

        return redirect()->route('motoristas.index')->with('success', 'Motorista criado com sucesso.');
    }

    public function show(Motorista $motorista)
    {
        $idade = $motorista->data_nascimento
            ? Carbon::parse($motorista->data_nascimento)->age
            : null;

        return view('motoristas.show', compact('motorista', 'idade'));
    }



    public function edit(Motorista $motorista)
    {
        return view('motoristas.edit', compact('motorista'));
    }

    public function update(Request $request, Motorista $motorista)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'numero_cnh' => 'required|string|max:50',
            'veiculo_marca' => 'required|string|max:100',
            'veiculo_modelo' => 'required|string|max:100',
            'veiculo_placa' => 'required|string|max:20',
            'data_nascimento' => 'nullable|date',
            'avaliacao_media' => 'nullable|integer|min:1|max:5',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($motorista->foto) {
                Storage::delete('public/' . $motorista->foto);
            }

            $validated['foto'] = $request->file('foto')->store('motoristas', 'public');
        }

        $motorista->update($validated);

        return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso.');
    }

    public function destroy(Motorista $motorista)
    {
        if ($motorista->foto) {
            Storage::delete('public/' . $motorista->foto);
        }

        $motorista->delete();

        return redirect()->route('motoristas.index')->with('success', 'Motorista excluído com sucesso.');
    }
}
