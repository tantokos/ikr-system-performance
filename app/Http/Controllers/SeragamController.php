<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeragamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mail = Auth::user()->email;
        $login = Employee::where('email', $mail)
                ->leftJoin('branches', 'employees.branch_id','=','branches.id')
                ->select('nik_karyawan', 'nama_karyawan','departement','posisi','nama_branch','email')
                ->first();

        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        return view('seragam.data_seragam',
            ['area' => $area, 'login' => $login]);
    }

    public function getKaryawanBranch(Request $request)
    {
        $br = explode("|", $request->branch);
        $branch = $br[1]; 
        $dtkry = DB::table('v_karyawan_callsign')->where('nama_branch', $branch)->get();

        return response()->json($dtkry);
    }

    public function simpanSeragam(Request $request)
    {
        dd($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
