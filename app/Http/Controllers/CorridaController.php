<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use App\Models\Motorista;
use Illuminate\Http\Request;

class CorridaController extends Controller
{
    public function index()
    {
        $corridas = Corrida::with('motorista')->paginate(10);
        return view('corridas.index', compact('corridas'));
    }

    public function create()
    {
        $motoristas = Motorista::all();
        return view('corridas.create', compact('motoristas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'origem' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'motorista_id' => 'required|exists:motoristas,id',
        ]);

        Corrida::create($request->all());

        return redirect()->route('corridas.index')->with('success', 'Corrida criada com sucesso!');
    }

    public function show(Corrida $corrida)
    {
        return view('corridas.show', compact('corrida'));
    }

    public function edit(Corrida $corrida)
    {
        $motoristas = Motorista::all();
        return view('corridas.edit', compact('corrida', 'motoristas'));
    }

    public function update(Request $request, Corrida $corrida)
    {
        $request->validate([
            'origem' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'motorista_id' => 'required|exists:motoristas,id',
        ]);

        $corrida->update($request->all());

        return redirect()->route('corridas.index')->with('success', 'Corrida atualizada com sucesso!');
    }

    public function destroy(Corrida $corrida)
    {
        $corrida->delete();
        return redirect()->route('corridas.index')->with('success', 'Corrida excluída com sucesso!');
    }
}
