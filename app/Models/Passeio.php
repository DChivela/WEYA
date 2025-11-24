<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passeio extends Model
{
    use SoftDeletes;

    protected $table = 'passeios';
    protected $fillable = ['nome', 'descricao','historia','preco','duracao_horas', 'local_partida', 'atividades','destino', 'itinerario', 'dicas_user', 'destaque', 'vagas', 'ativo', 'foto',];
    protected $casts = [
        'itinerario' => 'array',
        'destaque' => 'boolean',
        'atividades' => 'array',
        'dicas_user' => 'array',
        'ativo' => 'boolean',
    ];
}
