<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function index(Request $r)
    {
        $q = Motorista::query()
            ->when($r->status, fn($x)=>$x->where('status',$r->status))
            ->orderByDesc('id');
        return $q->paginate($r->get('per_page',15));
    }

    public function show(Motorista $motorista){ return response()->json($motorista); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'usuario_id'     => 'nullable|exists:usuarios,id',
            'nome'           => 'required|string|max:150',
            'email'          => 'nullable|email',
            'telefone'       => 'nullable|string|max:30',
            'numero_cnh'     => 'nullable|string|max:80',
            'validade_cnh'   => 'nullable|date',
            'veiculo_marca'  => 'nullable|string|max:80',
            'veiculo_modelo' => 'nullable|string|max:80',
            'veiculo_placa'  => 'nullable|string|max:30',
            'status'         => 'nullable|in:disponivel,indisponivel,em_viagem',
            'avaliacao_media'=> 'nullable|numeric|min:0|max:5',
            'local_atual'    => 'nullable|array',
        ]);
        $m = Motorista::create($data);
        return response()->json($m, 201);
    }

    public function update(Request $r, Motorista $motorista)
    {
        $data = $r->validate([
            'usuario_id'     => 'nullable|exists:usuarios,id',
            'nome'           => 'sometimes|string|max:150',
            'email'          => 'nullable|email',
            'telefone'       => 'nullable|string|max:30',
            'numero_cnh'     => 'nullable|string|max:80',
            'validade_cnh'   => 'nullable|date',
            'veiculo_marca'  => 'nullable|string|max:80',
            'veiculo_modelo' => 'nullable|string|max:80',
            'veiculo_placa'  => 'nullable|string|max:30',
            'status'         => 'nullable|in:disponivel,indisponivel,em_viagem',
            'avaliacao_media'=> 'nullable|numeric|min:0|max:5',
            'local_atual'    => 'nullable|array',
        ]);
        $motorista->update($data);
        return response()->json($motorista);
    }

    public function destroy(Motorista $motorista)
    {
        $motorista->delete();
        return response()->json(['ok'=>true]);
    }
}
