<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorista extends Model
{
    use SoftDeletes;

    protected $table = 'motoristas';
    protected $fillable = [
    'usuario_id',
    'nome',
    'email',
    'telefone',
    'numero_cnh',
    'veiculo_marca',
    'veiculo_modelo',
    'veiculo_placa',
    'status',
    'avaliacao_media',
    'local_atual',
    'foto',
    'data_nascimento',
    ];
    protected $casts = [
        'local_atual' => 'array'
    ];

    public function corridas()
    {
        return $this->hasMany(Corrida::class, 'motorista_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function getIdadeAttribute()
{
    return $this->data_nascimento
        ? Carbon::parse($this->data_nascimento)->age
        : null;
}

}
