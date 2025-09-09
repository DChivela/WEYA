<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $r)
    {
        $q = Usuario::query()
            ->when($r->q, fn($x) => $x->where(function($w) use($r){
                $w->where('nome','like',"%{$r->q}%")
                  ->orWhere('email','like',"%{$r->q}%")
                  ->orWhere('telefone','like',"%{$r->q}%");
            }))
            ->orderByDesc('id');

        return $q->paginate($r->get('per_page', 15));
    }

    public function show(Usuario $usuario) { return response()->json($usuario); }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nome'     => 'required|string|max:150',
            'email'    => 'required|email|unique:usuarios,email',
            'telefone' => 'nullable|string|max:30',
            'password' => 'required|string|min:6',
            'perfil'   => 'nullable|in:usuario,admin',
        ]);
        $data['password'] = Hash::make($data['password']);
        $u = Usuario::create($data);
        return response()->json($u, 201);
    }

    public function update(Request $r, Usuario $usuario)
    {
        $data = $r->validate([
            'nome'     => 'sometimes|string|max:150',
            'email'    => 'sometimes|email|unique:usuarios,email,'.$usuario->id,
            'telefone' => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6',
            'perfil'   => 'nullable|in:usuario,admin',
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']);
        $usuario->update($data);
        return response()->json($usuario);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(['ok'=>true]);
    }
}
