<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Corrida;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CorridaController extends Controller
{
    public function index(Request $r)
    {
        $q = Corrida::query()
            ->when($r->estado, fn($x) => $x->where('estado', $r->estado))
            ->when($r->usuario_id, fn($x) => $x->where('usuario_id', $r->usuario_id))
            ->when($r->motorista_id, fn($x) => $x->where('motorista_id', $r->motorista_id))
            ->orderByDesc('id');

        return $q->paginate($r->get('per_page', 15));
    }

    public function show(Corrida $corrida)
    {
        return response()->json($corrida);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'tipo'           => 'required|string|in:regular,pacote,compartilhada',
            'origem_lat'     => 'required|numeric',
            'origem_lng'     => 'required|numeric',
            'destino_lat'    => 'required|numeric',
            'destino_lng'    => 'required|numeric',
            'origem_endereco'=> 'nullable|string',
            'destino_endereco'=> 'nullable|string',
            'agendado_para'  => 'nullable|date',
        ]);

        $distancia_km      = $this->calculaDistancia($data['origem_lat'], $data['origem_lng'], $data['destino_lat'], $data['destino_lng']);
        $duracao_segundos  = $this->duracaoEstimativaSegundos($distancia_km); // heurística simples
        $tarifas           = $this->tarifas();
        $preco             = Corrida::calcularPreco($distancia_km, $duracao_segundos, [
            'base'   => $tarifas['base'],
            'por_km' => $tarifas['por_km'],
            'por_min'=> $tarifas['por_min'],
        ]);

        $corrida = Corrida::create(array_merge($data, [
            'usuario_id'       => $r->user()->id ?? null,
            'distancia_km'     => $distancia_km,
            'duracao_segundos' => $duracao_segundos,
            'preco'            => $preco,
            'tarifa_base'      => $tarifas['base'],
            'tarifa_km'        => $tarifas['por_km'],
            'tarifa_minuto'    => $tarifas['por_min'],
            'estado'           => 'pendente',
        ]));

        // event(new \App\Events\NovaCorrida($corrida)); // opcional

        return response()->json($corrida, 201);
    }

    public function update(Request $r, Corrida $corrida)
    {
        $data = $r->validate([
            'tipo'              => 'sometimes|string|in:regular,pacote,compartilhada',
            'estado'            => 'sometimes|string|in:pendente,aceite,em_andamento,concluida,cancelada',
            'observacoes'       => 'nullable|string',
            'agendado_para'     => 'nullable|date',
            'origem_lat'        => 'nullable|numeric',
            'origem_lng'        => 'nullable|numeric',
            'destino_lat'       => 'nullable|numeric',
            'destino_lng'       => 'nullable|numeric',
            'origem_endereco'   => 'nullable|string',
            'destino_endereco'  => 'nullable|string',
        ]);

        // Se alterar coordenadas, recalcula distância/preço
        if (isset($data['origem_lat'], $data['origem_lng'], $data['destino_lat'], $data['destino_lng'])) {
            $d = $this->calculaDistancia($data['origem_lat'], $data['origem_lng'], $data['destino_lat'], $data['destino_lng']);
            $t = $this->duracaoEstimativaSegundos($d);
            $tar = $this->tarifas();
            $data['distancia_km']     = $d;
            $data['duracao_segundos'] = $t;
            $data['preco'] = Corrida::calcularPreco($d, $t, [
                'base' => $tar['base'], 'por_km'=>$tar['por_km'], 'por_min'=>$tar['por_min']
            ]);
        }

        $corrida->update($data);
        return response()->json($corrida);
    }

    public function destroy(Corrida $corrida)
    {
        $corrida->delete();
        return response()->json(['ok' => true]);
    }

    public function aceitar(Request $r, Corrida $corrida)
    {
        $data = $r->validate(['motorista_id' => 'required|exists:motoristas,id']);
        if ($corrida->estado !== 'pendente') {
            return response()->json(['erro' => 'Corrida não está pendente.'], 422);
        }
        $corrida->update([
            'motorista_id' => $data['motorista_id'],
            'estado'       => 'aceite',
        ]);
        // event(new \App\Events\CorridaAtualizada($corrida));
        return response()->json($corrida);
    }

    public function iniciar(Corrida $corrida)
    {
        if (!in_array($corrida->estado, ['aceite','pendente'])) {
            return response()->json(['erro' => 'Estado inválido para iniciar.'], 422);
        }
        $corrida->update([
            'estado'      => 'em_andamento',
            'iniciada_em' => Carbon::now(),
        ]);
        return response()->json($corrida);
    }

    public function finalizar(Corrida $corrida)
    {
        if ($corrida->estado !== 'em_andamento') {
            return response()->json(['erro' => 'Estado inválido para finalizar.'], 422);
        }
        $corrida->update([
            'estado'        => 'concluida',
            'finalizada_em' => Carbon::now(),
        ]);
        return response()->json($corrida);
    }

    /** ===== Utilitários ===== */

    private function calculaDistancia(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        // Haversine – retorno em KM
        $raioTerra = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return round($raioTerra * $c, 3);
    }

    private function duracaoEstimativaSegundos(float $distancia_km, int $velocidade_kmh = 28): int
    {
        // Heurística conservadora urbana (28 km/h média). Nunca < 5 min.
        $seg = (int) round(($distancia_km / max($velocidade_kmh, 5)) * 3600);
        return max($seg, 300);
    }

    private function tarifas(): array
    {
        // TODO: trazer de BD/config; defaults para MVP
        return ['base' => 300, 'por_km' => 150, 'por_min' => 20]; // valores em KZ (A nossa moeda local)
    }
}
