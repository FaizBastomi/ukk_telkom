<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $photos = Foto::all();
        return view('home', compact('photos'));
    }
}
