@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Corrida</h1>
    <form method="POST" action="{{ route('corridas.update', $corrida) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Origem</label>
            <input type="text" name="origem" value="{{ $corrida->origem }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Destino</label>
            <input type="text" name="destino" value="{{ $corrida->destino }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" value="{{ $corrida->preco }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
