<?php

namespace App\Http\Controllers;

use App\Models\DataAssignTim;
use App\Models\Employee;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RekapAssignTimController extends Controller
{
    public function index()
    {
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $leader = DB::table('v_detail_callsign_tim')->select('leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->select('id','nama_branch')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance','Teknisi'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->orderBy('nama_karyawan')
            ->get();
        
        $cluster = DB::table('fats')->select('cluster')
                ->where('cluster', '<>', "")->distinct()->orderBy('cluster')->get();

        return view('assign.rekap_assign_tim', ['leadCallsign' => $Leadcallsign, 'leader' => $leader, 
                                        'branches' => $branches, 'callTim' => $callTim, 
                                        'cluster' => $cluster, 'tim' => $tim]);
    }

    public function getTabelRekapAssignTim(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_rekap_summary_tim as vtim')   
                ->leftJoin('v_rekap_assign_tek as vtek', function($join) {
                    $join->on('vtim.branch','=',DB::raw('vtek.branch'))
                        ->where('vtim.tgl_ikr','=',DB::raw('vtek.tgl_ikr'))
                        ->where('vtim.departement','=',DB::raw('vtek.departement'));
                })
                ->select(DB::raw('vtim.branch, vtim.departement,
                                sum(vtim.jml_tim) as j_tim,
                                sum(vtim.jml_assign) as j_assign, 
                                sum(vtek.jml_teknisi) as j_teknisi,
                                sum(vtim.jml_on) as j_on,
                                sum(vtim.jml_off) as j_off,
                                sum(vtim.jml_cuti) as j_cuti,
                                sum(vtim.jml_sakit) as j_sakit,
                                sum(vtim.jml_abs) as j_abs'))
                
                ->groupBy('vtim.branch_id','vtim.branch','vtim.departement')
                ->orderBy(DB::raw('case when vtim.branch="Jakarta Timur" then 1
                            when vtim.branch="Jakarta Selatan" then 2
                            when vtim.branch="Bekasi" then 3
                            when vtim.branch="Bogor" then 4
                            when vtim.branch="Tangerang" then 5
                            when vtim.branch="Medan" then 6
                            when vtim.branch="Pangkal Pinang" then 7
                            when vtim.branch="Pontianak" then 8
                            when vtim.branch="Jambi" then 9
                            when vtim.branch="Bali" then 10
                            when vtim.branch="Palembang" then 11 end'));       
        
            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('vtim.tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('vtim.wo_no', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            if($request->filtypeWo != null) {
                $datas = $datas->where('jenis_wo', $request->filtypeWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('vtim.branch', $br);
            }
            if($request->filleaderTim != null) {
                $lt = explode("|", $request->filleaderTim);
                $ld = $lt[1];
                $datas = $datas->where('vtim.login', $ld);
            }
            if($request->filcallsignTimid != null) {
                $fct = explode("|", $request->filcallsignTimid);
                $ct = $fct[1];
                $datas = $datas->where('callsign', $ct);
            }
            if($request->filteknisi != null) {
                $ftk = explode("|", $request->filteknisi );
                $nikTk = $ftk[0];
                $datas = $datas->where('tek1_nik', $nikTk)
                                ->orWhere('tek2_nik', $nikTk)
                                ->orWhere('tek3_nik', $nikTk)
                                ->orWhere('tek4_nik', $nikTk);
            }
            if($request->filcluster != null) {
                $datas = $datas->where('area', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('fat_code', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            // $dtJadwal = $dtJadwal->get();
            // $datas = $datas->get();

            $datas = $datas->get();
 
        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="showDetRekapAssignTim" name="showDetRekapAssignTim" data-id= "'. $row->branch . '" class="btn btn-sm btn-dark btn-icon align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    //'
                    //<a href="javascript:void(0)" id="detail-assign" data-id="' . $row->branch . '" class="btn btn-sm btn-primary detail-assign mb-0" ><i class="bi bi-info-circle"></i></a>';
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

    public function getTabelLeadAssignTim(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('v_lead_assign_tim')
                ->select('login','branch',DB::raw('sum(ftth_ib) as ftth_ib, sum(ftth_mt) as ftth_mt, sum(dismantle) as dismantle, sum(fttx_ib) as fttx_ib, sum(fttx_mt) as fttx_mt'))
                ->groupBy('login','branch')
                ->orderBy('branch', 'DESC')->orderBy('login');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('wo_no', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            if($request->filtypeWo != null) {
                $datas = $datas->where('jenis_wo', $request->filtypeWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            if($request->filleaderTim != null) {
                $lt = explode("|", $request->filleaderTim);
                $ld = $lt[1];
                $datas = $datas->where('login', $ld);
            }
            if($request->filcallsignTimid != null) {
                $fct = explode("|", $request->filcallsignTimid);
                $ct = $fct[1];
                $datas = $datas->where('callsign', $ct);
            }
            if($request->filteknisi != null) {
                $ftk = explode("|", $request->filteknisi );
                $nikTk = $ftk[0];
                $datas = $datas->where('tek1_nik', $nikTk)
                                ->orWhere('tek2_nik', $nikTk)
                                ->orWhere('tek3_nik', $nikTk)
                                ->orWhere('tek4_nik', $nikTk);
            }
            if($request->filcluster != null) {
                $datas = $datas->where('area', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('fat_code', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            $datas = $datas->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran                
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="showDetAssignTim" name="showDetAssignTim" data-id= "'. $row->branch . "|" . $row->login . '" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    //'
                    //<a href="javascript:void(0)" id="detail-assign" data-id="' . $row->branch . '" class="btn btn-sm btn-primary detail-assign mb-0" ><i class="bi bi-info-circle"></i></a>';
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

    public function getDetailLeadAssignTim(Request $request)
    {
        // dd($request);
        $akses = Auth::user()->name;

        $datas = DB::table('data_assign_tims')->orderBy('tgl_ikr', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filBrnchLead != null) {
                $BrLead = explode("|", $request->filBrnchLead);
                $branch = $BrLead[0];
                $lead = $BrLead[1];

                $datas = $datas->where('branch',$branch)->where('login',$lead);
            }

            $datas=$datas->get();

            // dd($datas);

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('name_cust_apk', function ($nm) {
                    return Str::title($nm->name_cust_apk);
                })
                ->editColumn('wo_type_apk', function ($nm) {
                    return Str::title($nm->wo_type_apk);
                })
                ->editColumn('area_cluster_apk', function ($nm) {
                    return Str::title($nm->area_cluster_apk);
                })
                ->editColumn('branch', function ($nm) {
                    return Str::title($nm->branch);
                })
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
