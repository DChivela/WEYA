<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motorista extends Model
{
    use SoftDeletes;

    protected $table = 'motoristas';
    protected $fillable = [
        'usuario_id','nome','email','telefone','numero_cnh','veiculo_marca','veiculo_modelo','veiculo_placa','status','avaliacao_media','local_atual'
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
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
