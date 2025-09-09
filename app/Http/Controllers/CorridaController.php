<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CorridaController extends Controller
{
    public function index()
    {
        $corridas = Corrida::with('motorista')->paginate(10);
        return view('corridas.index', compact('corridas'));
    }

    public function create()
    {
        $motoristas = Motorista::all();
        return view('corridas.create', compact('motoristas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'motorista_id'     => 'required|exists:motoristas,id',
            'tipo'             => 'required|string',
            'origem_endereco'  => 'required|string',
            'destino_endereco' => 'required|string',
            'origem_lat'       => 'required|numeric',
            'origem_lng'       => 'required|numeric',
            'destino_lat'      => 'required|numeric',
            'destino_lng'      => 'required|numeric',
        ]);

        // Cálculo da distância (Haversine)
        $distanciaKm = $this->haversine(
            $request->origem_lat,
            $request->origem_lng,
            $request->destino_lat,
            $request->destino_lng
        );

        // Duração aproximada (velocidade média: 40km/h)
        $duracaoSegundos = ($distanciaKm / 40) * 3600;

        // Tarifas fixas (pode vir do request ou config)
        $tarifaBase = 500;
        $tarifaKm = 150;
        $tarifaMinuto = 50;

        // Preço = tarifa base + (distância * tarifa_km) + (minutos * tarifa_minuto)
        $preco = $tarifaBase + ($distanciaKm * $tarifaKm) + (($duracaoSegundos / 60) * $tarifaMinuto);

        // Cria corrida
        Corrida::create([
            'usuario_id'       => Auth::id(),
            'motorista_id'     => $request->motorista_id,
            'tipo'             => $request->tipo,
            'origem_endereco'  => $request->origem_endereco,
            'destino_endereco' => $request->destino_endereco,
            'origem_lat'       => $request->origem_lat,
            'origem_lng'       => $request->origem_lng,
            'destino_lat'      => $request->destino_lat,
            'destino_lng'      => $request->destino_lng,
            'observacoes'      => $request->observacoes,
            'agendado_para'    => $request->agendado_para,
            'distancia_km'     => $distanciaKm,
            'duracao_segundos' => round($duracaoSegundos),
            'tarifa_base'      => $tarifaBase,
            'tarifa_km'        => $tarifaKm,
            'tarifa_minuto'    => $tarifaMinuto,
            'preco'            => round($preco),
            'estado'           => 'pendente',
        ]);

        return redirect()->route('corridas.index')->with('success', 'Corrida criada com sucesso!');
    }

    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }




    public function show(Corrida $corrida)
    {
        return view('corridas.show', compact('corrida'));
    }

    public function edit(Corrida $corrida)
    {
        $motoristas = Motorista::all();
        return view('corridas.edit', compact('corrida', 'motoristas'));
    }

    public function update(Request $request, Corrida $corrida)
    {
        $request->validate([
            'motorista_id'      => 'required|exists:motoristas,id',
            'tipo'              => 'required|string|max:30',
            'origem_endereco'   => 'required|string|max:255',
            'destino_endereco'  => 'required|string|max:255',
            'distancia_km'      => 'nullable|numeric',
            'duracao_segundos'  => 'nullable|integer',
            'preco'             => 'nullable|numeric',
            'tarifa_base'       => 'nullable|numeric',
            'tarifa_km'         => 'nullable|numeric',
            'tarifa_minuto'     => 'nullable|numeric',
            'estado'            => 'required|in:pendente,aceite,em_andamento,concluida,cancelada',
            'observacoes'       => 'nullable|string',
            'agendado_para'     => 'nullable|date',
        ]);

        $dados = $request->all();
        $dados['usuario_id'] = Auth::id(); // mantém associação ao user autenticado

        $corrida->update($dados);

        return redirect()->route('corridas.index')->with('success', 'Corrida atualizada com sucesso!');
    }

    public function destroy(Corrida $corrida)
    {
        $corrida->delete();
        return redirect()->route('corridas.index')->with('success', 'Corrida excluída com sucesso!');
    }


}
