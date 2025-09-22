<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $table = 'promocaos';
    protected $fillable = ['codigo', 'descricao', 'desconto_percent', 'desconto_valor', 'validade_de', 'validade_ate', 'uso_maximo', 'uso_por_usuario', 'ativo'];
    protected $casts = [
        'validade_de' => 'date',
        'validade_ate' => 'date',
        'ativo' => 'boolean',
    ];
}
