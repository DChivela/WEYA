<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonus';
    protected $fillable = ['usuario_id','tipo','valor','descricao','expira_em'];
    protected $casts = ['expira_em' => 'datetime'];

    public function usuario(){ return $this->belongsTo(Usuario::class); }
}
