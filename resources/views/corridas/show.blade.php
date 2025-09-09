@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Corrida</h1>
    <ul>
        <li><strong>ID:</strong> {{ $corrida->id }}</li>
        <li><strong>Origem:</strong> {{ $corrida->origem }}</li>
        <li><strong>Destino:</strong> {{ $corrida->destino }}</li>
        <li><strong>Preço:</strong> {{ $corrida->preco }}</li>
    </ul>
    <a href="{{ route('corridas.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
