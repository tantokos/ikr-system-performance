<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Monitoring_FTTH_IB extends Controller
{
    public function index(Request $request)
    {
        return view('monitoringWo.monit_assign_tim');
    }
}
