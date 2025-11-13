<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
        public function index()
    {
        $hoteis = Hotel::paginate(15);
        return view('hoteis.index', compact('hoteis'));
    }
}
