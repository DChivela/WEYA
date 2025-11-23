<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PacoteTuristico extends Model
{
    use SoftDeletes;

    protected $table = 'pacotes_turisticos';
    protected $fillable = ['nome','descricao','preco','duracao_dias','local_partida','destino','itinerario','incluido','vagas','ativo','foto',];
    protected $casts = [
        'itinerario' => 'array',
        'incluido' => 'array',
        'ativo' => 'boolean',
         // para gravar várias fotos como um array JSON
    ];
}
