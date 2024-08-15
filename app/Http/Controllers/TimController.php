<?php

namespace App\Http\Controllers;

use App\Models\CallsignLead;
use App\Models\Employee;
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
        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();
        $leaderName = DB::table('employees')->where('posisi', 'like', 'Leader%')->get();

        return view('tim.data_Tim', ['area' => $area, 'namaLeader' => $leaderName]);
    }

    public function getDataLead(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('callsign_leads as c')
                ->leftJoin('employees as e', 'c.leader_id', '=', 'e.nik_karyawan')
                ->leftJoin('branches as b', 'e.branch_id', '=', 'b.id')
                ->select('c.*', 'e.nik_karyawan', 'e.nama_karyawan', 'e.posisi', 'e.branch_id', 'b.nama_branch')
                ->orderBy('e.branch_id')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="detail-lead" data-id="' . $row->id . "|" . $row->branch_id . "|" . $row->nik_karyawan . '" class="btn btn-sm btn-primary detil-lead mb-1" >Show Detail</a>';
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
        $leaderName = DB::table('employees')->where('posisi', 'like', 'Leader%')->where('branch_id', '=', $request->filArea)->get();

        return response()->json(['leadName' => $leaderName]);
    }

    public function getPosisi(request $request)
    {
        $posisi = Employee::where('nik_karyawan', '=', $request->filNikLead)->select('posisi')->first();

        return response()->json($posisi);
    }

    public function simpanLead(Request $request)
    {
        $akses = Auth::user()->name;

        $request->validate([
            'leadCallsign' => ['required', 'unique:Callsign_Leads,lead_callsign'],
            'area' => 'required',
            'namaLeader' => 'required',
        ]);

        CallsignLead::create([
            'lead_callsign' => $request->leadCallsign,
            'leader_id' => $request->namaLeader,
        ]);

        return redirect()->route('dataTim')->with(['success' => 'Data tersimpan.']);
    }

    public function getDetailLead(Request $request)
    {
        $area = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();
        $callsignLead = DB::table('callsign_leads as c')->where('c.id', '=', $request->filCallsignId)
            ->leftJoin('employees as e', 'e.nik_karyawan', '=', 'c.leader_id')
            ->leftJoin('branches as b', 'e.branch_id', '=', 'b.id')
            ->select('c.*', 'e.branch_id', 'b.nama_branch', 'e.posisi')->first();

        $leaderName = DB::table('employees')->select('nik_karyawan', 'nama_karyawan', 'posisi')->where('posisi', 'like', 'Leader%')->where('branch_id', '=', $request->filBranchId)->get();

        // $area = Branch::all();
        return response()->json(['callsignLead' => $callsignLead, 'leaderName' => $leaderName, 'area' => $area]);
    }

    public function updateLead(Request $request, CallsignLead $Callsignn, $id)
    {
        $lead_callsign = $request->leadCallsign;
        $leader_id = $request->idLeader;

        $callsignLead = CallsignLead::find($id);

        $callsignLead->update([
            'lead_callsign' => $lead_callsign,
            'leader_id' => $leader_id
        ]);


        return response()->json(['success' => true, 'message' => 'Data tersimpan.']);
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
