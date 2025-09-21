<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

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
        $data = $request->all();

        // Upload da foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('motoristas', 'public');
        }

        Motorista::create($data);

        return redirect()->route('motoristas.index')->with('success', 'Motorista criado com sucesso.');
    }

    public function show(Motorista $motorista)
    {
        return view('motoristas.show', compact('motorista'));
    }

    public function edit(Motorista $motorista)
    {
        return view('motoristas.edit', compact('motorista'));
    }

    public function update(Request $request, Motorista $motorista)
    {
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('motoristas', 'public');
        }

        $motorista->update($data);

        return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso.');
    }

    public function destroy(Motorista $motorista)
    {
        $motorista->delete();
        return redirect()->route('motoristas.index')->with('success', 'Motorista excluído com sucesso.');
    }
}
