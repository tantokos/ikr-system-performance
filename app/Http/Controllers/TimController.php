<?php

namespace App\Http\Controllers;

use App\Models\CallsignLead;
use App\Models\CallsignTim;
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
        $dtLeadCallsign = DB::table('callsign_leads')->get();

        return view('tim.data_Tim', ['area' => $area, 'namaLeader' => $leaderName, 'dtLeadCallsign' => $dtLeadCallsign]);
    }

    public function getDataLead(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            // $datas = DB::table('callsign_leads as c')
            //     ->leftJoin('employees as e', 'c.leader_id', '=', 'e.nik_karyawan')
            //     ->leftJoin('branches as b', 'e.branch_id', '=', 'b.id')
            //     ->select('c.*', 'e.nik_karyawan', 'e.nama_karyawan', 'e.posisi', 'e.branch_id', 'b.nama_branch')
            //     ->orderBy('e.branch_id')->get();
            $datas = DB::table('v_detail_callsign_tot')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="showDetail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary showDetail-lead mb-0" >Detail</a>
                    <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->addColumn('jml_teknisi', function ($t) {
                    $tek = $t->jml_teknisi1 + $t->jml_teknisi2 + $t->jml_teknisi3 + $t->jml_teknisi4;

                    return $tek;
                })
                ->rawColumns(['action', 'jml_teknisi'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getDataTim(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $tims = DB::table('v_detail_callsign_tim')
                ->orderBy('branch_id')->orderBy('lead_callsign')->orderBy('callsign_tim')->get();

            return DataTables::of($tims)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="detail-tim" data-id="' . $row->callsign_tim_id . "|" . $row->lead_call_id . "|" . $row->leader_id . "|" . $row->branch_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
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

    public function showDetailLead(Request $request)
    {
        $showLead = DB::table('v_detail_callsign_tim')->where('lead_call_id', '=', $request->filCallsignId)
            ->select('lead_call_id', 'lead_callsign', 'nama_leader', 'nama_branch', 'posisi')->distinct()->first();

        $show = DB::table('v_detail_callsign_tim')->where('lead_call_id', '=', $request->filCallsignId)
            ->orderBy('lead_callsign')->orderBy('callsign_tim')->get();

        return response()->json(['showLead' => $showLead, 'showTim' => $show]);
    }

    public function getListTool(Request $request)
    {
        // dd($request->all());
        $req = explode('|', $request->tid);
        $callTimId = $req[0];

        // $idTool = $request->tid;

        if ($request->ajax()) {

            // $dtRw = DataDistribusiTool::where('barang_id', $idTool)->get();
            $dtRw = DB::table('v_history_tools')
                ->where('callsign_tim_id', $callTimId)
                ->where('status_kembali', '=', 'Belum dikembalikan')->get();

            return DataTables::of($dtRw)
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

    public function getDataShowTim(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $tims = DB::table('v_detail_callsign_tim')->where('lead_call_id', '=', $request->leadCall)
                ->orderBy('branch_id')->orderBy('lead_callsign')->orderBy('callsign_tim')->get();

            return DataTables::of($tims)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" id="detail-tim" data-id="' . $row->callsign_tim_id . "|" . $row->lead_call_id . "|" . $row->leader_id . "|" . $row->branch_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->addColumn('tools', function ($row) {
                    $tools = '<a href="javascript:void(0)" id="detail-tool" data-id="' . $row->callsign_tim_id . "|" . $row->lead_call_id . "|" . $row->leader_id . "|" . $row->branch_id . '" class="btn btn-sm btn-primary detail-tool mb-0" >Tools</a>
                    <a href="javascript:void(0)" id="detail-wo" data-id="' . $row->callsign_tim_id . "|" . $row->callsign_tim . "|" . "|" . $row->lead_call_id . "|" . $row->leader_id . "|" . $row->branch_id . '" class="btn btn-sm btn-primary detail-wo mb-0" >WO</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $tools;
                })
                ->rawColumns(['action', 'tools'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getListWo(Request $request)
    {
        // dd($request);
        $akses = Auth::user()->name;
        $req = explode('|', $request->reqCallTim);
        $callTim = $req[1];

        if ($request->ajax()) {

            $datas = DB::table('data_assign_tims')
                ->where('callsign', '=', $callTim)->orderBy('tgl_ikr', 'DESC')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
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

    public function getDataLeadCallsign(Request $request)
    {
        // dd($request->all());
        $datas = DB::table('callsign_leads as c')
            ->leftJoin('employees as e', 'c.leader_id', '=', 'e.nik_karyawan')
            ->leftJoin('branches as b', 'e.branch_id', '=', 'b.id')
            ->select('c.*', 'e.nik_karyawan', 'e.nama_karyawan', 'e.posisi', 'e.branch_id', 'b.nama_branch')
            ->where('c.id', '=', $request->filLeadId)
            ->orderBy('e.branch_id')->first();


        $branch_id = $datas->branch_id;
        $tim1 = collect(CallsignTim::pluck('nik_tim1 as nik_tim')->whereNotNull()->all());
        $tim2 = collect(CallsignTim::pluck('nik_tim2 as nik_tim')->whereNotNull()->all());
        $tim3 = collect(CallsignTim::pluck('nik_tim3 as nik_tim')->whereNotNull()->all());
        $tim4 = collect(CallsignTim::pluck('nik_tim4 as nik_tim')->whereNotNull()->all());

        $tim = $tim1->merge($tim2)->merge($tim3)->merge($tim4);

        $dtTim = Employee::where('branch_id', $branch_id)->whereNotIn('nik_karyawan', $tim)
            ->whereIn('posisi', ['Installer', 'Maintenance'])
            ->get();

        return response()->json(['callLead' => $datas, 'tim1' => $dtTim]);
    }

    public function getTeknisi(Request $request)
    {
        // dd($request->all());

        $branch_id = $request->area;

        $tim1 = collect(CallsignTim::pluck('nik_tim1 as nik_tim')->whereNotNull()->all());
        $tim2 = collect(CallsignTim::pluck('nik_tim2 as nik_tim')->whereNotNull()->all());
        $tim3 = collect(CallsignTim::pluck('nik_tim3 as nik_tim')->whereNotNull()->all());
        $tim4 = collect(CallsignTim::pluck('nik_tim4 as nik_tim')->whereNotNull()->all());

        $tim = $tim1->merge($tim2)->merge($tim3)->merge($tim4);

        // $branchid = Employee::find($leaderid);


        $tim = Employee::where('branch_id', $branch_id)->whereNotIn('nik_karyawan', $tim)
            ->whereIn('posisi', ['Installer', 'Maintenance'])
            ->orderBy('nama_karyawan')
            ->get();

        return response()->json($tim);
    }

    public function simpanTim(Request $request)
    {
        $akses = Auth::user()->name;

        $request->validate([
            'callsignTim' => ['required', 'unique:Callsign_Tims,callsign_tim'],
        ]);

        CallsignTim::create([
            'callsign_tim' => $request->callsignTim,
            'nik_tim1' => $request->teknisi1,
            'nik_tim2' => $request->teknisi2,
            'nik_tim3' => $request->teknisi3,
            'nik_tim4' => $request->teknisi4,
            'lead_callsign' => $request->LeadCallsignTim,

        ]);

        return redirect()->route('dataTim')->with(['success' => 'Data Tim tersimpan.']);
    }

    public function getDetailTim(Request $request)
    {
        $callsignTim = DB::table('v_detail_callsign_tim')->where('callsign_tim_id', '=', $request->callTimEdit)
            ->first();

        return response()->json($callsignTim);
    }

    public function updateTim(Request $request, CallsignTim $Callsigntim, $id)
    {
        $leadTimId = $request->idLeadTim;
        $callTimId = $request->idCallTim;
        $tim1 = $request->tim1;
        $tim2 = $request->tim2;
        $tim3 = $request->tim3;
        $tim4 = $request->tim4;

        $callsignTim = CallsignTim::find($id);

        $callsignTim->update([
            'lead_callsign' => $leadTimId,
            'nik_tim1' => $tim1,
            'nik_tim2' => $tim2,
            'nik_tim3' => $tim3,
            'nik_tim4' => $tim4,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil di update.']);
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
