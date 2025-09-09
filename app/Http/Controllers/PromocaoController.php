<?php

namespace App\Http\Controllers;

use App\Models\Promocao;
use Illuminate\Http\Request;

class PromocaoController extends Controller
{
    public function index()
    {
        $promocoes = Promocao::paginate(15);
        return view('promocoes.index', compact('promocoes'));
    }

    public function create()
    {
        return view('promocoes.create');
    }

    public function store(Request $request)
    {
        Promocao::create($request->all());
        return redirect()->route('promocoes.index')->with('success', 'Promoção criada com sucesso.');
    }

    public function show(Promocao $promocao)
    {
        return view('promocoes.show', compact('promocao'));
    }

    public function edit(Promocao $promocao)
    {
        return view('promocoes.edit', compact('promocao'));
    }

    public function update(Request $request, Promocao $promocao)
    {
        $promocao->update($request->all());
        return redirect()->route('promocoes.index')->with('success', 'Promoção atualizada com sucesso.');
    }

    public function destroy(Promocao $promocao)
    {
        $promocao->delete();
        return redirect()->route('promocoes.index')->with('success', 'Promoção excluída com sucesso.');
    }
}
