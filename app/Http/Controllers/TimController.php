<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen','Underground'])->get();
        $leaderName = DB::table('employees')->where('posisi','like','Leader%')->get();

        return view('tim.data_Tim', ['area' => $area, 'namaLeader' => $leaderName]);
    }

    public function getDataLead(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('callsign_leads as c')
                    ->leftJoin('employees as e', 'c.leader_id','=','e.nik_karyawan')
                    ->leftJoin('branches as b', 'e.branch_id', '=', 'b.id')
                    ->select('c.*', 'e.nama_karyawan', 'e.posisi', 'e.branch_id', 'b.nama_branch')
                    ->orderBy('e.branch_id')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/detailKaryawan/'. $row->id.'" class="btn btn-sm btn-primary edit-barang mb-1" >Show Detail</a>';
                            //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getLeader(Request $request)
    {
        
        $leaderName = DB::table('employees')->where('posisi','like','Leader%')->where('branch_id','=', $request->filArea)->get();

        return response()->json(['leadName' => $leaderName]);
        
    }

    public function simpanLead(Request $request)
    {
        // dd($request->all());

        return response()->json(['success' => 'Data tidak tersimpan.']);
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
