<?php

namespace App\Http\Controllers;

use App\Models\CallsignLead;
use App\Models\DataDistribusiTool;
use App\Models\Employee;
use App\Models\ToolIkr;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class DistribusiToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();
        // $tool = ToolIkr::where('status_distribusi', '=', 'Not Distributed')->get();

        return view('vTool.distribusi_tool', ['leadCallsign' => $Leadcallsign]);
    }

    public function getDataDistribusi(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('data_distribusi_tools')->orderBy('tgl_distribusi', 'DESC')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-distribusi" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-distribusi mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getDetailDistribusi(Request $request)
    {
        $email_login = Auth::user()->email;
        $akses = Auth::user()->akses;
        $data_login = Employee::where('email', $email_login)->first();

        if ($data_login->posisi == "Supervisor" || $akses == "SA") {
            $approve = $request->filDisId . "|" . $data_login->nik_karyawan . "|" . $data_login->nama_karyawan;
        } else {
            $approve = "-";
        }

        // dd($approve);
        $datas = DB::table('data_distribusi_tools as d')
            ->leftJoin('tool_ikrs as t', 'd.barang_id', '=', 't.id')
            ->select('d.*', 't.foto_barang', 't.tgl_pengadaan', DB::raw('"' . $approve . '" as approve '))
            ->where('d.id', $request->filDisId)->first();

        return response()->json($datas);
    }

    public function approveDistribusi(Request $request)
    {
        $approval = explode('|', $request->approve);
        $disId = $approval[0];
        $nik = $approval[1];
        $nama = $approval[2];
        $dt = Carbon::now();

        // dd($dt);

        $dtDis = DataDistribusiTool::find($disId);

        $dtDis->update([
            'approve_nik' => $nik,
            'approve_spv' => $nama,
            'approve_date' => $dt
        ]);

        // $disTool = DataDistribusiTool::find($>)
        return response()->json(['success' => true]);
    }

    public function getLeadCallsign(Request $request)
    {
        // dd($request->all());
        $datas = DB::table('callsign_leads as c')
            ->leftJoin('employees as e', 'c.leader_id', '=', 'e.nik_karyawan')
            ->leftJoin('branches as b', 'e.branch_id', '=', 'b.id')
            ->select('c.*', 'e.nik_karyawan', 'e.nama_karyawan', 'e.posisi', 'e.branch_id', 'b.nama_branch')
            ->where('c.id', '=', $request->filLeadId)
            ->orderBy('e.branch_id')->first();

        $callTim = DB::table('v_detail_callsign_tim')->where('lead_call_id', $request->filLeadId)
            ->select('callsign_tim_id', 'callsign_tim')->distinct()->get();

        return response()->json(['callLead' => $datas, 'callTim' => $callTim]);
    }

    public function getTim(Request $request)
    {
        $branch_id = $request->area;
        $leadCall = $request->leadCall;
        $callTim = $request->callTim;

        $teknisi = DB::table('v_detail_callsign_tim')
            ->where('lead_call_id', $leadCall)
            ->where('callsign_tim_id', $callTim)
            ->first();

        return response()->json($teknisi);
    }

    public function getSelectTool(Request $request)
    {
        $tool = ToolIkr::where('status_distribusi', 'Stock')//->where('kondisi', 'Baik')
            ->where('posisi','Stock Branch')->where('approve1','Approved')->where('approve2','Approved')
            ->where('branch_penerima', $request->area)
            ->select('id', 'nama_barang', 'merk_barang', 'satuan', 'spesifikasi', 'tgl_pengadaan', 'kondisi', 'kode_aset', 'kode_ga', 'foto_barang')
            ->orderBy('nama_barang')->get();

        return response()->json($tool);
    }

    public function simpanDistribusi(Request $request)
    {
        $login = Auth::user()->name;
        $loginid = Auth::user()->id;

        $brg_id = $request->namaToolid;

        if ($request->hasFile('fotoToolDistribusi')) {
            $fileFoto = $request->file('fotoToolDistribusi');
            $file = $fileFoto->hashName();
            $request->file('fotoToolDistribusi')->move(public_path('storage/image-distribusi'), $file);
        } else {
            $file = 'foto-blank.jpg';
        }

        $simpanDistribusi = DataDistribusiTool::create([
            'tgl_distribusi' => $request['tglDistribusi'],
            'barang_id' => $request['namaToolid'],
            'nama_barang' => $request['namaTool'],
            'merk_barang' => $request['merk'],
            'kondisi' => $request['kondisi'],
            'satuan' => $request['satuan'],
            'kode_aset' => $request['kodeAset'],
            'kode_ga' => $request['kodeGA'],
            'spesifikasi' => $request['spesifikasi'],
            'leadcall_id' => $request['LeadCallsignTim'],
            'lead_callsign' => $request['leadCallsign'],
            'leader_id' => $request['leaderid'],
            'leader' => $request['leaderTim'],
            'posisi' => $request['posisiTim'],
            'callsign_tim_id' => $request['callsignTimid'],
            'callsign_tim' => $request['callsignTim'],
            'area' => $request['areaTim'],
            'nik_tim1' => $request['teknisi1Nk'],
            'teknisi1' => $request['teknisi1'],
            'nik_tim2' => $request['teknisi2Nk'],
            'teknisi2' => $request['teknisi2'],
            'nik_tim3' => $request['teknisi3Nk'],
            'teknisi3' => $request['teknisi3'],
            'nik_tim4' => $request['teknisi4Nk'],
            'teknisi4' => $request['teknisi4'],
            'status_distribusi' => "Distributed",
            'keterangan' => $request['keterangan'],
            'foto_distribusi' => $file,
            'login_id' => $loginid,
            'login' => $login,
        ]);

        if ($simpanDistribusi) {


            $toolDis = ToolIkr::find($brg_id);

            $toolDis->update([
                'status_distribusi' => "Distributed",
                'posisi' => $request['callsignTim']
            ]);
        }

        return redirect()->route('distribusiTool')->with(['success' => 'Data tersimpan.']);
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
