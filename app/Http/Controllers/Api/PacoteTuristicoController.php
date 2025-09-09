<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PacoteTuristico;
use Illuminate\Http\Request;

class PacoteTuristicoController extends Controller
{
    public function index(Request $r)
    {
        $q = PacoteTuristico::query()
            ->when($r->ativo !== null, fn($x)=>$x->where('ativo', (bool)$r->ativo))
            ->orderByDesc('id');
        return $q->paginate($r->get('per_page', 15));
    }

    public function show(PacoteTuristico $pacote){ return response()->json($pacote); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nome'          => 'required|string|max:150',
            'descricao'     => 'nullable|string',
            'preco'         => 'required|numeric|min:0',
            'duracao_dias'  => 'required|integer|min:1',
            'local_partida' => 'nullable|string|max:150',
            'itinerario'    => 'nullable|array',
            'vagas'         => 'nullable|integer|min:1',
            'ativo'         => 'nullable|boolean',
        ]);
        $p = PacoteTuristico::create($data);
        return response()->json($p, 201);
    }

    public function update(Request $r, PacoteTuristico $pacote)
    {
        $data = $r->validate([
            'nome'          => 'sometimes|string|max:150',
            'descricao'     => 'nullable|string',
            'preco'         => 'sometimes|numeric|min:0',
            'duracao_dias'  => 'sometimes|integer|min:1',
            'local_partida' => 'nullable|string|max:150',
            'itinerario'    => 'nullable|array',
            'vagas'         => 'nullable|integer|min:1',
            'ativo'         => 'nullable|boolean',
        ]);
        $pacote->update($data);
        return response()->json($pacote);
    }

    public function destroy(PacoteTuristico $pacote)
    {
        $pacote->delete();
        return response()->json(['ok'=>true]);
    }
}
