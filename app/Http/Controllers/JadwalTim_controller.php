<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalTim_controller extends Controller
{

    public function index()
    {
        $akses = Auth::user()->name;

        return view('absensi.ikr_schedule', ['akses' => $akses]);
    }
}
