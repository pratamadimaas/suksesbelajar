<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;

class HomeController extends Controller
{
    public function index()
    {
        $pakets = Paket::where('is_active', true)->get();
        return view('home.index', compact('pakets'));
    }
}
