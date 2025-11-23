<?php

namespace App\Http\Controllers;

use App\Models\PacoteTuristico;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pacotesDestaque = PacoteTuristico::where('destaque', 1)
            ->where('ativo', 1)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('dashboard', compact('pacotesDestaque'));
    }
}
