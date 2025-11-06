<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacoteTuristico extends Model
{
    use SoftDeletes;

    protected $table = 'pacotes_turisticos';
    protected $fillable = ['nome','descricao','preco','duracao_dias','local_partida','itinerario','vagas','ativo',];
    protected $casts = [
        'itinerario' => 'array',
        'ativo' => 'boolean',
        'foto' => 'array', // para gravar várias fotos como um array JSON
    ];
}
