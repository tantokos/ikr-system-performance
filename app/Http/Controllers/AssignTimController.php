<?php

namespace App\Http\Controllers;

use App\Models\DataAssignTim;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AssignTimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->orderBy('nama_karyawan')
            ->get();
        
        $cluster = DB::table('fats')->select('cluster')
                ->where('cluster', '<>', "")->distinct()->orderBy('cluster')->get();

        return view('assign.assign_tim', ['leadCallsign' => $Leadcallsign, 'leader' => $leader, 
                                        'branches' => $branches, 'callTim' => $callTim, 
                                        'cluster' => $cluster, 'tim' => $tim]);
    }

    public function getTabelAssignTim(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('data_assign_tims')->orderBy('tgl_ikr', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('no_wo_apk', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id_apk', $request->filcustId);
            }
            if($request->filtypeWo != null) {
                $datas = $datas->where('type_wo', $request->filtypeWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            if($request->filleaderTim != null) {
                $lt = explode("|", $request->filleaderTim);
                $ld = $lt[1];
                $datas = $datas->where('leader', $ld);
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
                $datas = $datas->where('area_cluster_apk', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('fat_code_apk', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            $datas = $datas->get();

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

    public function getDetailAssign(Request $request)
    {
        // dd($request->all());
        $assignId = $request->filAssignId;
        $datas = DB::table('data_assign_tims as d')
            ->where('d.id', $assignId)->first();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->orderBy('nama_karyawan')
            ->get();

        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()->get();

        return response()->json(['data' => $datas, 'tim' => $tim, 'LeadCall' => $Leadcallsign, 'callTim' => $callTim]);
    }

    public function getLeadCallsignAssign(Request $request)
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

    public function getTeknisi(Request $request)
    {
        // dd($request->all());

        $branch_id = $request->area;

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->orderBy('nama_karyawan')
            ->get();

        return response()->json($tim);
    }

    public function simpanSignTim(Request $request)
    {
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;

        if ($request->branch) {
            $ReqBranch = explode('|', $request->branch);
            $branchId = $ReqBranch[0];
            $branchNm = $ReqBranch[1];
        }

        if ($request->LeadCallsign) {
            $ReqLeadCall = explode('|', $request->LeadCallsign);
            $leadCallId = $ReqLeadCall[0];
            $leadCall = $ReqLeadCall[1];
        } else {
            $leadCallId = $request->LeadCallsign;
            $leadCall = $request->LeadCallsign;
        }

        if ($request->teknisi1) {
            $ReqTek1 = explode('|', $request->teknisi1);
            $tek1Nk = $ReqTek1[0];
            $tek1 = $ReqTek1[1];
        } else {
            $tek1Nk = $request->teknisi1;
            $tek1 = $request->teknisi1;
        }

        if ($request->teknisi2) {
            $ReqTek2 = explode('|', $request->teknisi2);
            $tek2Nk = $ReqTek2[0];
            $tek2 = $ReqTek2[1];
        } else {
            $tek2Nk = $request->teknisi2;
            $tek2 = $request->teknisi2;
        }

        if ($request->teknisi3) {
            $ReqTek3 = explode('|', $request->teknisi3);
            $tek3Nk = $ReqTek3[0];
            $tek3 = $ReqTek3[1];
        } else {
            $tek3Nk = $request->teknisi3;
            $tek3 = $request->teknisi3;
        }

        if ($request->teknisi4) {
            $ReqTek4 = explode('|', $request->teknisi4);
            $tek4Nk = $ReqTek4[0];
            $tek4 = $ReqTek4[1];
        } else {
            $tek4Nk = $request->teknisi4;
            $tek4 = $request->teknisi4;
        }

        if ($request->callsignTimid) {
            $ReqCallsign = explode('|', $request->callsignTimid);
            $callsignId = $ReqCallsign[0];
            $callsign = $ReqCallsign[1];
        } else {
            $callsignId = $request->callsignTimid;
            $callsign = $request->callsignTimid;
        }

        $simpanAssignTim = DataAssignTim::create([
            'batch_wo' => $request['sesi'],
            'tgl_ikr' => $request['tglProgress'],
            'slot_time' => $request['slotTime'],
            'type_wo' => $request['jenisWo'],
            'no_wo_apk' => $request['noWo'],
            'no_ticket_apk' => $request['ticketNo'],
            'wo_date_apk' => $request['WoDate'],
            'cust_id_apk' => $request['custId'],
            'name_cust_apk' => $request['custName'],
            'cust_phone_apk' => $request['custPhone'],
            'cust_mobile_apk' => $request['custMobile'],
            'address_apk' => $request['custAddress'],
            'area_cluster_apk' => $request['area'],
            'wo_type_apk' => $request['woType'],
            'fat_code_apk' => $request['fatCode'],
            'fat_port_apk' => $request['portFat'],
            'remarks_apk' => $request['remarks'],
            'vendor_installer_apk' => "Misitel",
            'ikr_date_apk' => $request['ikrDateApk'],
            'time_apk' => $request['timeApk'],
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $request['leaderid'],
            'leader' => $request['leader'],
            'callsign_id' => $callsignId,
            'callsign' => $callsign,
            'tek1_nik' => $tek1Nk,
            'teknisi1' => $tek1,
            'tek2_nik' => $tek2Nk,
            'teknisi2' => $tek2,
            'tek3_nik' => $tek3Nk,
            'teknisi3' => $tek3,
            'tek4_nik' => $tek4Nk,
            'teknisi4' => $tek4,
            'login_id' => $aksesId,
            'login' => $akses
        ]);

        if ($simpanAssignTim) {
            return redirect()->route('assignTim')->with(['success' => 'Data tersimpan.']);
        } else {
            return redirect()->route('assignTim')->with(['error' => 'Gagal Simpan Data.']);
        }
    }

    public function updateSignTim(Request $request)
    {
        // dd($request->all());

        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $sin_id = $request->detId;

        if ($request->branchShow) {
            $ReqBranch = explode('|', $request->branchShow);
            $branchId = $ReqBranch[0];
            $branchNm = $ReqBranch[1];
        }

        if ($request->LeadCallsignShow) {
            $ReqLeadCall = explode('|', $request->LeadCallsignShow);
            $leadCallId = $ReqLeadCall[0];
            $leadCall = $ReqLeadCall[1];
        } else {
            $leadCallId = $request->LeadCallsignShow;
            $leadCall = $request->LeadCallsignShow;
        }

        if ($request->teknisi1Show) {
            $ReqTek1 = explode('|', $request->teknisi1Show);
            $tek1Nk = $ReqTek1[0];
            $tek1 = $ReqTek1[1];
        } else {
            $tek1Nk = $request->teknisi1Show;
            $tek1 = $request->teknisi1Show;
        }

        if ($request->teknisi2Show) {
            $ReqTek2 = explode('|', $request->teknisi2Show);
            $tek2Nk = $ReqTek2[0];
            $tek2 = $ReqTek2[1];
        } else {
            $tek2Nk = $request->teknisi2Show;
            $tek2 = $request->teknisi2Show;
        }

        if ($request->teknisi3Show) {
            $ReqTek3 = explode('|', $request->teknisi3Show);
            $tek3Nk = $ReqTek3[0];
            $tek3 = $ReqTek3[1];
        } else {
            $tek3Nk = $request->teknisi3Show;
            $tek3 = $request->teknisi3Show;
        }

        if ($request->teknisi4Show) {
            $ReqTek4 = explode('|', $request->teknisi4Show);
            $tek4Nk = $ReqTek4[0];
            $tek4 = $ReqTek4[1];
        } else {
            $tek4Nk = $request->teknisi4Show;
            $tek4 = $request->teknisi4Show;
        }

        if ($request->callsignTimidShow) {
            $ReqCallsign = explode('|', $request->callsignTimidShow);
            $callsignId = $ReqCallsign[0];
            $callsign = $ReqCallsign[1];
        } else {
            $callsignId = $request->callsignTimidShow;
            $callsign = $request->callsignTimidShow;
        }

        $dataAssign = DataAssignTim::findOrFail($sin_id);

        $updateAssignTim = $dataAssign->update([
            'batch_wo' => $request['sesiShow'],
            'tgl_ikr' => $request['tglProgressShow'],
            'slot_time' => $request['slotTimeShow'],
            'type_wo' => $request['jenisWoShow'],
            'no_wo_apk' => $request['noWoShow'],
            'no_ticket_apk' => $request['ticketNoShow'],
            'wo_date_apk' => $request['WoDateShow'],
            'cust_id_apk' => $request['custIdShow'],
            'name_cust_apk' => $request['custNameShow'],
            'cust_phone_apk' => $request['custPhoneShow'],
            'cust_mobile_apk' => $request['custMobileShow'],
            'address_apk' => $request['custAddressShow'],
            'area_cluster_apk' => $request['areaShow'],
            'wo_type_apk' => $request['woTypeShow'],
            'fat_code_apk' => $request['fatCodeShow'],
            'fat_port_apk' => $request['portFatShow'],
            'remarks_apk' => $request['remarksShow'],
            // 'vendor_installer' => "MisitelShow",
            'ikr_date_apk' => $request['ikrDateApkShow'],
            'time_apk' => $request['timeApkShow'],
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $request['leaderidShow'],
            'leader' => $request['leaderShow'],
            'callsign_id' => $callsignId,
            'callsign' => $callsign,
            'tek1_nik' => $tek1Nk,
            'teknisi1' => $tek1,
            'tek2_nik' => $tek2Nk,
            'teknisi2' => $tek2,
            'tek3_nik' => $tek3Nk,
            'teknisi3' => $tek3,
            'tek4_nik' => $tek4Nk,
            'teknisi4' => $tek4,
            'login_id' => $aksesId,
            'login' => $akses
        ]);

        if ($updateAssignTim) {
            return redirect()->route('assignTim')->with(['success' => 'Data tersimpan.']);
        } else {
            return redirect()->route('assignTim')->with(['error' => 'Gagal Simpan Data.']);
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
