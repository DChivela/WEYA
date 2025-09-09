<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corrida extends Model
{
    use SoftDeletes;

    protected $table = 'corridas';
    protected $fillable = [
        'usuario_id','motorista_id','tipo',
        'origem_lat','origem_lng','origem_endereco',
        'destino_lat','destino_lng','destino_endereco',
        'distancia_km','duracao_segundos','preco',
        'tarifa_base','tarifa_km','tarifa_minuto',
        'estado','observacoes','agendado_para','iniciada_em','finalizada_em'
    ];
    protected $dates = ['agendado_para','iniciada_em','finalizada_em'];

    public function usuario(){ return $this->belongsTo(Usuario::class, 'usuario_id'); }
    public function motorista(){ return $this->belongsTo(Motorista::class, 'motorista_id'); }

    // método utilitário para calcular preço aproximado
    public static function calcularPreco(float $distancia_km, int $duracao_segundos, array $tarifas): float
    {
        // tarifas esperadas: ['base'=>x,'por_km'=>y,'por_min'=>z]
        $minutos = ceil($duracao_segundos / 60);
        $preco = ($tarifas['base'] ?? 0)
               + ($tarifas['por_km'] ?? 0) * $distancia_km
               + ($tarifas['por_min'] ?? 0) * $minutos;
        return round(max($preco, 0), 2);
    }
}
