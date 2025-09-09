<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            'origem' => 'required|string',
            'destino' => 'required|string',
            'observacoes' => 'nullable|string',
            'agendado_para' => 'nullable|date',
        ]);

        $corrida = new Corrida();

        $corrida->motorista_id = auth()->id(); // ou selecionado no form
        $corrida->origem = $request->origem;
        $corrida->destino = $request->destino;
        $corrida->observacoes = $request->observacoes;
        $corrida->agendado_para = $request->agendado_para;

        // Default valores calculáveis
        $corrida->duracao_segundos = 0; // até calcular a rota
        $corrida->preco = 500;          // nota mínima permitida
        $corrida->tarifa_base = 500;    // valor fixo inicial
        $corrida->tarifa_km = 150;      // exemplo, 150 kz/km
        $corrida->tarifa_minuto = 50;   // exemplo, 50 kz/min
        $corrida->estado = 'pendente';  // estados: pendente, em_andamento, concluida

        $corrida->save();

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
            'motorista_id'      => 'required|exists:motoristas,id',
            'tipo'              => 'required|string|max:30',
            'origem_endereco'   => 'required|string|max:255',
            'destino_endereco'  => 'required|string|max:255',
            'distancia_km'      => 'nullable|numeric',
            'duracao_segundos'  => 'nullable|integer',
            'preco'             => 'nullable|numeric',
            'tarifa_base'       => 'nullable|numeric',
            'tarifa_km'         => 'nullable|numeric',
            'tarifa_minuto'     => 'nullable|numeric',
            'estado'            => 'required|in:pendente,aceite,em_andamento,concluida,cancelada',
            'observacoes'       => 'nullable|string',
            'agendado_para'     => 'nullable|date',
        ]);

        $dados = $request->all();
        $dados['usuario_id'] = Auth::id(); // mantém associação ao user autenticado

        $corrida->update($dados);

        return redirect()->route('corridas.index')->with('success', 'Corrida atualizada com sucesso!');
    }

    public function destroy(Corrida $corrida)
    {
        $corrida->delete();
        return redirect()->route('corridas.index')->with('success', 'Corrida excluída com sucesso!');
    }
}
