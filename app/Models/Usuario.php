<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $table = 'usuarios';
    protected $fillable = ['nome','email','telefone','password','perfil','credito','meta'];
    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'meta' => 'array',
        'email_verified_at' => 'datetime',
    ];

    public function corridas()
    {
        return $this->hasMany(Corrida::class, 'usuario_id');
    }

    public function bonus()
    {
        return $this->hasMany(Bonus::class);
    }
}
