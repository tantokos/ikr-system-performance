<?php

namespace App\Http\Controllers\FTTX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignTeamController extends Controller
{
    public function index()
    {
        return view('fttx.assign-team.index');
    }
}
