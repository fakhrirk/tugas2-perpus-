<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TamuController extends Controller
{
    public function index()
    {
        return view('tamu.index'); // This view exists in your files
    }
    
    // Add this method
    public function dashboard()
    {
        return view('tamu.index');
    }
}
