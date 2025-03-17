<?php

namespace App\Http\Controllers;

use App\Exports\FtthDismantleExport;
use App\Models\FtthDismantle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FtthDismantleController extends Controller
{
    public function index(Request $request)
    {
        $areaFill = $request->areaFill;
        $areagroup = $request->areagroup;

        $branches = DB::table('branches')->select('id','nama_branch')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $leader = DB::table('v_detail_callsign_tim')->select('leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        $cluster = DB::table('fats')->select('cluster')
                ->where('cluster', '<>', "")->distinct()->orderBy('cluster')->get();

        $dtDispatch = DB::table('list_dispatch')->get();

        $penagihanDismantle = DB::table('root_couse_penagihan')->select('status','penagihan')
                    ->where('type_wo','=','Dismantle FTTH')->where('penagihan','<>','total_done')->get();

        return view('ftth-dismantle.index', compact(
            'branches',
            'leader',
            'callTim',
            'cluster',
            'dtDispatch',
            'penagihanDismantle',
            'areaFill', 'areagroup'
        ));
    }

    public function getSummaryWODismantle(Request $request)
    {
        $datas = DB::table('data_ftth_dismantle_oris');

        if($request->filTgl != null) {
            $dateRange = explode("-", $request->filTgl);
            $startDt = \Carbon\Carbon::parse($dateRange[0]);
            $endDt = \Carbon\Carbon::parse($dateRange[1]);

            $datas = $datas->whereBetween('visit_date',[$startDt, $endDt]);
        }

        if($request->filGroup == null && $request->filarea != null) {
            $b = explode("|", $request->filarea);
            $br = $b[1];
            $datas = $datas->where('main_branch', $br);
        }

        if($request->filcluster != null) {
            $datas = $datas->where('cluster', $request->filcluster);
        }
        if($request->filfatCode != null) {
            $datas = $datas->where('kode_fat', $request->filfatCode);
        }
        if($request->filslotTime != null) {
            $datas = $datas->where('slot_time', $request->filslotTime);
        }

        if ($request->filGroup != null) {

            $group = $request->filGroup;

            $grupArea = DB::table('branches')
                ->where('grup_dismantle', 'like', '%' . $group . '%')
                ->pluck('nama_branch')
                ->toArray();

            $datas = $datas->whereIn('main_branch', $grupArea);

        }

        $datas = $datas->select(
                    DB::raw('
                    count(*) as total,
                    count(if((status_wo="Done") || (status_wo="Checkout"),1,null)) as done,
                    count(if(status_wo="Pending",1,null)) as pending,
                    count(if(status_wo="Cancel",1,null)) as cancel,
                    count(if(status_wo="Checkin",1,null)) as checkin,
                    count(if(status_wo="Requested",1,null)) as requested ')
                )->get();

        return response()->json($datas);
    }

    public function getFtthDismantle(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        // $datas = DB::table('data_ftth_dismantle_oris')->orderBy('visit_date', 'DESC');
        $datas = DB::table('data_ftth_dismantle_oris')->orderBy('visit_date', 'DESC')
                ->orderBy('is_checked')
                ->orderByRaw('case when status_apk="CHECKOUT" then 1
                                when status_apk="DONE" then 2
                                when status_apk="PENDING" then 3
                                when status_apk="CANCELLED" then 4
                                when status_apk="CHECKIN" then 5
                                when status_apk="REQUESTED" then 6
                                else 7 End'
                            );

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('visit_date',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('no_wo', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            if($request->filstatusWo != null) {
                $datas = $datas->where('status_wo', $request->filstatusWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('main_branch', $br);
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
                $datas = $datas->where('cluster', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('kode_fat', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }
            if ($request->filGroup != null) {

                $group = $request->filGroup;

                $grupArea = DB::table('branches')
                    ->where('grup_dismantle', 'like', '%' . $group . '%')
                    ->pluck('nama_branch')
                    ->toArray();

                $datas = $datas->whereIn('main_branch', $grupArea);

            }

            $datas = $datas->get();


        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('nama_cust', function ($nm) {
                    return Str::title($nm->nama_cust);
                })
                // ->editColumn('type_wo', function ($nm) {
                //     return Str::title($nm->type_wo);
                // })
                // ->editColumn('cluster', function ($nm) {
                //     return Str::title($nm->cluster);
                // })
                // ->editColumn('branch', function ($nm) {
                //     return Str::title($nm->branch);
                // })
                ->addColumn('action', function ($row) {
                    $btn = '
                        <a href="javascript:void(0)"
                        id="detail-assign"
                        data-id="' . $row->id . '"
                        class="btn btn-sm btn-primary detail-assign mb-0">
                        Detail
                        </a>
                        <a href="javascript:void(0)"
                        id="detail-material"
                        data-id="' . $row->id . '"
                        class="btn btn-sm btn-secondary detail-material mb-0">
                        Material
                        </a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return response()->json($request->ajax());
    }

    public function getDetailFtthDismantle(Request $request)
    {
        $akses = Auth::user()->name;
        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_dismantle_oris as d')
            ->where('d.id', $assignId)->first();

        $callsign_tims = DB::table('callsign_tims')->get();
        $callsign_leads = DB::table('callsign_leads as clead')
                ->leftJoin('employees as e','clead.leader_id', '=','e.nik_karyawan')
                ->select('clead.id','clead.lead_callsign','clead.leader_id','e.nama_karyawan')->get();

        $assignTim = DB::table('v_rekap_assign_tim')
                    ->where('tgl_ikr', $datas->visit_date)->get();

        $teknisiOn = DB::table('v_rekap_jadwal_data as vj')
        ->leftJoin('employees as e', 'vj.nik_karyawan', '=', 'e.nik_karyawan')
        ->whereDate('vj.tgl', $datas->visit_date) // Ganti where() dengan whereDate()
        ->where('e.posisi', 'like', '%Teknisi%')
        ->whereIn('vj.status', ["ON", "OD"])
        ->select('vj.nik_karyawan', 'e.nama_karyawan')
        ->orderBy('e.nama_karyawan')
        ->get();


        $wo_no = DB::table('data_ftth_dismantle_oris')->where('id', $assignId)->value('no_wo'); // contoh WO No

        // Mendapatkan data dari database seperti biasa
        $ftth_dismantle_material = DB::table('ftth_dismantle_materials')
                ->select(

                    'id',
                    'status_item',
                    'item_code',
                    'description',
                    'qty',
                    'sn',
                    'mac_address',
                )
                ->where('wo_no', $wo_no)
                ->get();

        // Mengirimkan response JSON
        return response()->json([
            'data' => $datas,
            'callsign_tims' => $callsign_tims,
            'callsign_leads' => $callsign_leads,
            'ftth_dismantle_material' => $ftth_dismantle_material,
            'assignTim' => $assignTim,
            'teknisiOn' => $teknisiOn,
            'akses' => $akses
        ]);

    }

    public function getMaterialFtthDismantle(Request $request)
    {
        try {
            // Ambil assignId dari request
            $assignId = $request->filAssignId;

            // Ambil data dari tabel 'data_ftth_dismantle_oris' berdasarkan assignId
            $datas = DB::table('data_ftth_dismantle_oris as d')->where('d.id', $assignId)->first();

            // Jika tidak ditemukan, kembalikan respons error
            if (!$datas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            // Ambil nomor WO berdasarkan assignId
            $wo_no = DB::table('data_ftth_dismantle_oris')->where('id', $assignId)->value('no_wo');

            // Ambil data material berdasarkan nomor WO
            $ftth_dismantle_material = DB::table('ftth_dismantle_materials')
                ->select(
                    'id',
                    'status_item',
                    'item_code',
                    'description',
                    'qty',
                    'sn',
                    'mac_address',
                    'material_condition'
                )
                ->where('wo_no', $wo_no)
                ->get();

            // Kembalikan response dalam format JSON
            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $ftth_dismantle_material,
            ], 200);

        } catch (\Exception $e) {
            // Tangani error dan kembalikan respons JSON
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateFtthDismantle(Request $request)
    {
        // dd($request->all());
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $id = $request->detId;

        $ftthDismantle = FtthDismantle::findOrFail($id);

        $updateFtthDismantle = $ftthDismantle->update([
            'type_wo' => $request['woTypeShow'],
            'no_wo' => $request['noWoShow'],
            'no_ticket' => $request['ticketNoShow'],
            'cust_id' => $request['custIdShow'],
            'nama_cust' => $request['custNameShow'],
            'cust_address1' => $request['custAddressShow'],
            'kode_fat' => $request['fatCodeShow'],
            'cluster' => $request['cluster'],
            'branch' => $request['branchShow'],
            'visit_date' => $request['tglProgressShow'],
            'slot_time_leader' => $request['slotTimeLeaderShow'],
            'slot_time_apk' => $request['slotTimeAPKShow'],
            'sesi' => $request['sesiShow'],
            'waktu_instalasi' => $request['waktuInstallation'],
            'material_in' => $request['materialIn'],
            'selisih_menit' => $request['statusCheckinMenit'],
            'status_checkin' => $request['statusCheckin'],
            'leader' => $request['leaderShow'],
            'teknisi1' => $request['teknisi1Show'],
            'teknisi2' => $request['teknisi2Show'],
            'teknisi3' => $request['teknisi3Show'],
            'status_apk' => $request['statusWoApk'],
            'status_wo' => $request['statusWo'],
            'action_status' => $request['actionStatus'],
            'remarks' => $request['report_teknisi'],
            'reschedule_date' => $request['tglReschedule'],
            'reschedule_time' => $request['jamReschedule'],
            'penagihan' => $request['rootCausePenagihan'],
            'tgl_dismantle_port' => $request['tglDismantlePort'],
            'reason_status' => $request['reasonStatus'],
            'tgl_jam_reschedule' => $request['tglReschedule'],
            'weather' => $request['weatherShow'],
            'start' => $request['start'],
            'finish' => $request['finish'],
            'ms_regular' => $request['ms_regular'],
            'tarik_cable' => $request['tarik_cable'],
            'checkin_apk' => $request['tglCheckinApk'],
            'checkout_apk' => $request['tglCheckoutApk'],
            'wo_date_apk' => $request['WoDateShow'],
            'ont_merk_out' => $request['ont_merk_out'],
            'ont_sn_out' => $request['snOntOut'],
            'ont_merk_in' => $request['merkOntIn'],
            'ont_mac_in' => $request['macOntIn'],
            'router_sn_out' => $request['snRouterOut'],
            'router_mac_out' => $request['macRouterOut'],
            'router_merk_in' => $request['merkRouterIn'],
            'router_sn_in' => $request['snRouterIn'],
            'router_mac_in' => $request['macRouterIn'],
            'stb_merk_out' => $request['merkStbOut'],
            'stb_sn_out' => $request['snStbOut'],
            'stb_mac_out' => $request['macStbOut'],
            'stb_merk_in' => $request['merkStbIn'],
            'stb_sn_in' => $request['snStbIn'],
            'stb_mac_in' => $request['macStbIn'],
            'precon_out' => $request['kabelPrecon'],
            'leader_id' => $request['leaderidShow'],
            'callsign_id' => $request['callsign_id'],
            'pic_dispatch' => $request['picDispatch'],
            'telp_dispatch' => $request['telp_dispatch'],
            'detail_alasan' => $request['detailAlasan'],
            'alasan_pending' => $request['alasan_pending'],
            'alasan_cancel' => $request['alasan_cancel'],
            'alasan_no_rollback' => $request['alasan_no_rollback'],
            'takeout_notakeout' => $request['takeout_notakeout'],
            'is_checked' => $request['is_checked'],
            'login_id' => $aksesId,
            'login' => $akses,
        ]);

        if ($updateFtthDismantle) {
            return redirect()->route('ftth-dismantle')->with(['success' => 'Data tersimpan.']);
        } else {
            return redirect()->route('ftth-dismantle')->with(['error' => 'Gagal Simpan Data.']);
        }
    }

    public function getDetailCustId(Request $request)
    {

        $detail_customer = DB::table('v_history_customers')
        ->where('cust_id', $request->cust_id)
        ->get();

        if ($request->ajax()) {

            return DataTables::of($detail_customer)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->cust_id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
        }
    }

    public function export(Request $request)
    {
        $export = new FtthDismantleExport($request);
        return Excel::download($export, 'FTTH_Dismantle.xlsx');
    }

    public function editMaterialDismantle(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('ftth_dismantle_materials as d')
            ->where('d.id', $assignId)->first();

        return response()->json($datas);
    }

    public function updateMaterialDismantle(Request $request)
    {
        // Validasi data jika diperlukan
        $id = $request->detId;

        // Perbarui data langsung menggunakan query builder
        DB::table('ftth_dismantle_materials')
            ->where('id', $id)
            ->update([
                'status_item' => $request['status_item'],
                'item_code' => $request['item_code'],
                'qty' => $request['qty'],
                'sn' => $request['sn'],
                'mac_address' => $request['mac_address'],
                'description' => $request['description'],
            ]);

        return redirect()->route('ftth-dismantle')
            ->with('success', 'Berhasil mengubah data material dismantle');
    }

}
