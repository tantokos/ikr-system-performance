<?php

namespace App\Http\Controllers\FTTX;

use App\Http\Controllers\Controller;
use App\Models\DataAssignTimFttx;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AssignTeamFttxController extends Controller
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

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance', 'Teknisi'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->where('status_active','=','Aktif')
            ->orderBy('nama_karyawan')
            ->get();

        $cluster = DB::table('fats')->select('cluster')
                ->where('cluster', '<>', "")->distinct()->orderBy('cluster')->get();

        return view('fttx.assign-team.assignTimFttx', ['leadCallsign' => $Leadcallsign, 'leader' => $leader,
                                        'branches' => $branches, 'callTim' => $callTim,
                                        'cluster' => $cluster, 'tim' => $tim]);
    }

    public function getTabelAssignTimFttx(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('data_assign_tim_fttxs')->orderBy('jadwal_ikr', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0])->format('Y-m-d');
                $endDt = \Carbon\Carbon::parse($dateRange[1])->format('Y-m-d');

                $datas = $datas->whereBetween('jadwal_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('no_so', $request->filNoWo);
            }
            // if($request->filcustId != null) {
            //     $datas = $datas->where('cust_id_apk', $request->filcustId);
            // }
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
                $datas = $datas->where('area', $request->filcluster);
            }
            // if($request->filfatCode != null) {
            //     $datas = $datas->where('fat_code_apk', $request->filfatCode);
            // }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time_jadwal', $request->filslotTime);
            }

            $datas = $datas->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('name_cust_apk', function ($nm) {
                //     return Str::title($nm->name_cust_apk);
                // })
                // ->editColumn('wo_type', function ($nm) {
                //     return Str::title($nm->wo_type_apk);
                // })
                // ->editColumn('area', function ($nm) {
                //     return Str::title($nm->area_cluster_apk);
                // })
                // ->editColumn('branch', function ($nm) {
                //     return Str::title($nm->branch);
                // })
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

    public function simpanSignTimFttx(Request $request)
    {
        $this->validate($request, [
            'no_so' => 'required|unique:data_assign_tim_fttxs,no_so',
        ]);

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

        $simpanAssignTimFttx = DataAssignTimFttx::create([
            'no_so' => $request['no_so'],
            'so_date' => $request['so_date'],
            'customer_name' => $request['customer_name'],
            'address' => $request['address'],
            'pic_customer' => $request['pic_customer'],
            'phone_pic_cust' => $request['phone_pic_cust'],
            'wo_type' => $request['wo_type'],
            'product' => $request['product'],
            'remark_ewo' => $request['remark_ewo'],
            'cid' => $request['cid'],
            'segment_sales' => $request['segment_sales'],
            'area' => $request['area'],
            'jadwal_ikr' => $request['jadwal_ikr'],
            'slot_time_jadwal' => $request['slot_time_jadwal'],
            'remark_for_ikr' => $request['remark_for_ikr'],
            'status_penjadwalan' => $request['status_penjadwalan'],
            'vendor' => 'Misitel Jabodetabek',
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $request['leaderid'],
            'leader' => $request['leader'],
            'callsign_id' => $callsignId,
            'callsign' => $callsign,
            'tek1_nik' => $tek1Nk,
            'tim_1' => $tek1,
            'tek2_nik' => $tek2Nk,
            'tim_2' => $tek2,
            'tek3_nik' => $tek3Nk,
            'tim_3' => $tek3,
            'tek4_nik' => $tek4Nk,
            'tim_4' => $tek4,
            'nopol' => $request['nopol'],
            'perubahan_slot_time_tele' => $request['perubahan_slot_time_tele'],
            'checkin' => $request['checkin'],
            'checkout' => $request['checkout'],
            'status_wo' => $request['status_wo'],
            'keterangan_wo' => $request['keterangan_wo'],
            'login_id' => $aksesId,
            'login' => $akses
        ]);

        return redirect()->route('fttx-assign-team')->with(['success' => 'Data tersimpan.']);
    }

    public function getDetailAssignFttx(Request $request)
    {
        // dd($request->all());
        $assignId = $request->filAssignId;
        $datas = DB::table('data_assign_tim_fttxs as d')
            ->where('d.id', $assignId)->first();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance', 'Teknisi'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->where('status_active','=','Aktif')
            ->orderBy('nama_karyawan')
            ->get();

        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()->get();

        return response()->json(['data' => $datas, 'tim' => $tim, 'LeadCall' => $Leadcallsign, 'callTim' => $callTim]);
    }

    public function updateSignTimFttx(Request $request)
    {
        // dd($request->all());
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $det_id = $request->detId;

        if ($request->branch) {
            $ReqBranch = explode('|', $request->branch);
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

        if ($request->tim_1) {
            $ReqTek1 = explode('|', $request->tim_1);
            $tek1Nk = $ReqTek1[0];
            $tek1 = $ReqTek1[1];
        } else {
            $tek1Nk = $request->tim_1;
            $tek1 = $request->tim_1;
        }

        if ($request->tim_2) {
            $ReqTek2 = explode('|', $request->tim_2);
            $tek2Nk = $ReqTek2[0];
            $tek2 = $ReqTek2[1];
        } else {
            $tek2Nk = $request->tim_2;
            $tek2 = $request->tim_2;
        }

        if ($request->tim_3) {
            $ReqTek3 = explode('|', $request->tim_3);
            $tek3Nk = $ReqTek3[0];
            $tek3 = $ReqTek3[1];
        } else {
            $tek3Nk = $request->tim_3;
            $tek3 = $request->tim_3;
        }

        if ($request->tim_4) {
            $ReqTek4 = explode('|', $request->tim_4);
            $tek4Nk = $ReqTek4[0];
            $tek4 = $ReqTek4[1];
        } else {
            $tek4Nk = $request->tim_4;
            $tek4 = $request->tim_4;
        }

        if ($request->callsignTimidShow) {
            $ReqCallsign = explode('|', $request->callsignTimidShow);
            $callsignId = $ReqCallsign[0];
            $callsign = $ReqCallsign[1];
        } else {
            $callsignId = $request->callsignTimidShow;
            $callsign = $request->callsignTimidShow;
        }

        // dd($tek1);

        $dataAssignFttx = DataAssignTimFttx::findOrFail($det_id);

        $updateAssignTimFttx = $dataAssignFttx->update([
            'no_so' => $request['no_so'],
            'so_date' => $request['so_date'],
            'customer_name' => $request['customer_name'],
            'address' => $request['address'],
            'pic_customer' => $request['pic_customer'],
            'phone_pic_cust' => $request['phone_pic_cust'],
            'wo_type' => $request['wo_type'],
            'product' => $request['product'],
            'remark_ewo' => $request['remark_ewo'],
            'cid' => $request['cid'],
            'segment_sales' => $request['segment_sales'],
            'area' => $request['area'],
            'jadwal_ikr' => $request['jadwal_ikr'],
            'slot_time_jadwal' => $request['slot_time_jadwal'],
            'remark_for_ikr' => $request['remark_for_ikr'],
            'status_penjadwalan' => $request['status_penjadwalan'],
            'vendor' => 'Misitel Jabodetabek',
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $request['leaderidShow'],
            'leader' => $request['leaderShow'],
            'callsign_id' => $callsignId,
            'callsign' => $callsign,
            'tek1_nik' => $tek1Nk,
            'tim_1' => $tek1,
            'tek2_nik' => $tek2Nk,
            'tim_2' => $tek2,
            'tek3_nik' => $tek3Nk,
            'tim_3' => $tek3,
            'tek4_nik' => $tek4Nk,
            'tim_4' => $tek4,
            'nopol' => $request['nopol'],
            'perubahan_slot_time_tele' => $request['perubahan_slot_time_tele'],
            'checkin' => $request['checkin'],
            'checkout' => $request['checkout'],
            'status_wo' => $request['status_wo'],
            'keterangan_wo' => $request['keterangan_wo'],
            'login_id' => $aksesId,
            'login' => $akses
        ]);

        return redirect()->route('fttx-assign-team')->with(['success' => 'Data tersimpan.']);
    }
}
