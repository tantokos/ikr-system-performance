<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class analisa_woController extends Controller
{

    public function index(Request $request)
    {
        return view('assign.analisa_wo');
    }
}
