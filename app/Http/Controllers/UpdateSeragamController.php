<?php

namespace App\Http\Controllers;

use App\Models\DataDistribusiSeragam;
use App\Models\DataDistribusiSeragamDetail;
use App\Models\DataSeragam;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UpdateSeragamController extends Controller
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

        $kry = DB::table('employees as e')
                ->leftJoin('branches as b', 'e.branch_id','=','b.id')
                ->where('e.status_active','Aktif')
                ->where('b.nama_branch',$login->nama_branch)
                ->select('e.nik_karyawan','e.nama_karyawan','e.departement', 'e.posisi', 'e.branch_id','b.nama_branch')
                ->orderBy('e.nama_karyawan')->get();

        $stock = DB::table('data_seragams')->where('branch_seragam',$login->nama_branch)
                ->where('kondisi', 'Baik')
                ->select(DB::raw('branch_seragam, 
                            sum(if(ukuran="S", jml, 0)) as sizeS,
                            sum(if(ukuran="M", jml, 0)) as sizeM,
                            sum(if(ukuran="L", jml, 0)) as sizeL,
                            sum(if(ukuran="XL", jml, 0)) as sizeXL,
                            sum(if(ukuran="XXL", jml, 0)) as sizeXXL,
                            sum(if(ukuran="XXXL", jml, 0)) as sizeXXXL'))
                ->groupBy('branch_seragam')
                ->first();

        return view('seragam.update_seragam',['karyawan' => $kry, 'login' => $login, 'stock' => $stock, 'area' => $area]);
    }

    public function getStockTeknisi(Request $request)
    {
        $stock = DB::table('data_seragams')->where('nik_teknisi',$request->dtNik)
                ->get();

        return response()->json($stock);
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
