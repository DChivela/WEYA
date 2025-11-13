<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
        public function index()
    {
        $restaurantes = Restaurante::paginate(15);
        return view('restaurantes.index', compact('restaurantes'));
    }
}
