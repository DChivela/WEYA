<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promocao;
use Illuminate\Http\Request;

class PromocaoController extends Controller
{
    public function index(Request $r)
    {
        $q = Promocao::query()
            ->when($r->codigo, fn($x)=>$x->where('codigo','like',"%{$r->codigo}%"))
            ->when($r->ativo !== null, fn($x)=>$x->where('ativo',(bool)$r->ativo))
            ->orderByDesc('id');

        return $q->paginate($r->get('per_page', 15));
    }

    public function show(Promocao $promocao){ return response()->json($promocao); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'codigo'          => 'required|string|max:80|unique:promocaos,codigo',
            'descricao'       => 'nullable|string',
            'desconto_percent'=> 'nullable|numeric|min:0|max:100',
            'desconto_valor'  => 'nullable|numeric|min:0',
            'validade_de'     => 'nullable|date',
            'validade_ate'    => 'nullable|date|after_or_equal:validade_de',
            'uso_maximo'      => 'nullable|integer|min:1',
            'uso_por_usuario' => 'nullable|integer|min:1',
            'ativo'           => 'nullable|boolean',
        ]);
        $p = Promocao::create($data);
        return response()->json($p, 201);
    }

    public function update(Request $r, Promocao $promocao)
    {
        $data = $r->validate([
            'codigo'          => 'sometimes|string|max:80|unique:promocaos,codigo,'.$promocao->id,
            'descricao'       => 'nullable|string',
            'desconto_percent'=> 'nullable|numeric|min:0|max:100',
            'desconto_valor'  => 'nullable|numeric|min:0',
            'validade_de'     => 'nullable|date',
            'validade_ate'    => 'nullable|date|after_or_equal:validade_de',
            'uso_maximo'      => 'nullable|integer|min:1',
            'uso_por_usuario' => 'nullable|integer|min:1',
            'ativo'           => 'nullable|boolean',
        ]);
        $promocao->update($data);
        return response()->json($promocao);
    }

    public function destroy(Promocao $promocao)
    {
        $promocao->delete();
        return response()->json(['ok'=>true]);
    }
}
