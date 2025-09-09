<?php

namespace App\Http\Controllers;

use App\Models\PacoteTuristico;
use Illuminate\Http\Request;

class PacoteTuristicoController extends Controller
{
    public function index()
    {
        $pacotes = PacoteTuristico::paginate(15);
        return view('pacotes.index', compact('pacotes'));
    }

    public function create()
    {
        return view('pacotes.create');
    }

    public function store(Request $request)
    {
        PacoteTuristico::create($request->all());
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
        $pacote->update($request->all());
        return redirect()->route('pacotes.index')->with('success', 'Pacote atualizado com sucesso.');
    }

    public function destroy(PacoteTuristico $pacote)
    {
        $pacote->delete();
        return redirect()->route('pacotes.index')->with('success', 'Pacote excluído com sucesso.');
    }
}
