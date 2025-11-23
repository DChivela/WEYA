<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PacoteTuristico;

class PacotesDestaque extends Controller
{
    public function index()
    {
        // $pacotes = PacoteTuristico::all();

        $pacotesDestaque = PacoteTuristico::where('destaque', 1)
            ->where('ativo', 1)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('components.pacotes-destaque', compact('pacotesDestaque'));
    }
}
