<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DataAssignTim;
use App\Models\DataPendingReschedule;
use App\Models\Employee;
use App\Models\FtthMt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

use function Livewire\on;

class RescheduleWO_Controller extends Controller
{

    public function index()
    {
        return view('monitoringWo.reschedule_wo');
    }

    public function getDetailWORsch(Request $request)
    {

        $dtWO = DB::table('data_ftth_ib_oris')->select(DB::raw('*, "FTTH New Installation" as type'))->where('no_wo', $request->filWO)->orderBy('tgl_ikr', 'desc') ->first();
        
        if (is_null($dtWO)) {
            $dtWO = DB::table('data_ftth_mt_oris')->select(DB::raw('*, "FTTH Maintenance" as type'))->where('no_wo', $request->filWO)->orderBy('tgl_ikr', 'desc') ->first(); 
        }
        if (is_null($dtWO)) {
            $dtWO = DB::table('data_ftth_dismantle_oris')->select(DB::raw('*, "FTTH Dismantle" as type'))->where('no_wo', $request->filWO)->orderBy('visit_date', 'desc') ->first(); 
        }
        // if (count($dtWO) == 0) {
        //     $dtWO = DB::table('data_fttx_ib_oris')->where('no_wo', $request->filWO)->orderBy('visit_date', 'desc') ->first(); 
        // }
        if(is_null($dtWO)){
            return response()->json('NoData');
        } else {
            return response()->json($dtWO);
        }

    }

    public function simpanReschedule(Request $request)
    {
        $akses = Auth::user()->name;
        $aksesId = Auth::user()->id;

        if ($request->hasFile('fotoKonfirmCst')) {
            $fileFoto = $request->file('fotoKonfirmCst');
            $fileKonfirmCst = $fileFoto->hashName();
            $request->file('fotoKonfirmCst')->move(public_path('storage/image-pending'), $fileKonfirmCst);
        } else {
            $fileKonfirmCst = 'foto-blank.jpg';
        }

        if ($request->hasFile('fotoKonfirmDispatch')) {
            $fileFoto = $request->file('fotoKonfirmDispatch');
            $fileKonfirmDispatch = $fileFoto->hashName();
            $request->file('fotoKonfirmDispatch')->move(public_path('storage/image-pending'), $fileKonfirmDispatch);
        } else {
            $fileKonfirmDispatch = 'foto-blank.jpg';
        }

        DB::beginTransaction();

        try {

            $simpanPendingRsch = DataPendingReschedule::create([
                'wo_id' => $request['detId'],
                'type' => $request['woTypeShow'],
                'wo_no' => $request['noWoShow'],
                'installation_date' => $request['tglProgressShow'],
                'slot_time_leader' => $request['slotTimeLeaderShow'],
                'reschedule_date' => $request['tglReschedule'],
                'reschedule_time' => $request['slotTimeReschedule'],
                'keterangan' => $request['keterangan'],

                'konfirmasi_cst' => $fileKonfirmCst,
                'konfirmasi_dispatch' => $fileKonfirmDispatch,
                
                'login_id' => $aksesId,
                'login' => $akses
            ]);

            DB::commit();

            return redirect()->route('rescheduleWO')
                    ->with(['success' => 'Data tersimpan.']);
            

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('rescheduleWO')
            ->with(['error' => 'Gagal Simpan Data: ' . $e->getMessage()]);
        }

    }

    public function getRekapPendingReschedule(Request $request)
    {
        $akses = Auth::user()->name;
        
        $datas = DB::table('v_pending_rekap')
                ->select('branch', 'installation_date', 
                    DB::raw('sum(ftth_ib) as ftth_ib'),
                    DB::raw('sum(ftth_mt) as ftth_mt'),
                    DB::raw('sum(dismantle) as dismantle'),
                    DB::raw('sum(fttx_ib) as fttx_ib'),
                    DB::raw('sum(fttx_mt) as fttx_mt'),
                );
            // ->get();
        
        // $datas = DB::table('data_pending_reschedules')->leftJoin('')->orderBy('reschedule_date', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('installation_date',[$startDt, $endDt]);
            }

            // if($request->filNoWo != null) {
            //     $datas = $datas->where('wo_no', $request->filNoWo);
            // }
            // if($request->filcustId != null) {
            //     $datas = $datas->where('cust_id', $request->filcustId);
            // }
            // if($request->filtypeWo != null) {
            //     $datas = $datas->where('type_wo', $request->filtypeWo);
            // }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            // if($request->filleaderTim != null) {
            //     $lt = explode("|", $request->filleaderTim);
            //     $ld = $lt[1];
            //     $datas = $datas->where('leader', $ld);
            // }
            // if($request->filcallsignTimid != null) {
            //     $fct = explode("|", $request->filcallsignTimid);
            //     $ct = $fct[1];
            //     $datas = $datas->where('callsign', $ct);
            // }
            // if($request->filteknisi != null) {
            //     $ftk = explode("|", $request->filteknisi );
            //     $nikTk = $ftk[0];
            //     $datas = $datas->where('tek1_nik', $nikTk)
            //                     ->orWhere('tek2_nik', $nikTk)
            //                     ->orWhere('tek3_nik', $nikTk)
            //                     ->orWhere('tek4_nik', $nikTk);
            // }
            // if($request->filcluster != null) {
            //     $datas = $datas->where('cluster', $request->filcluster);
            // }
            // if($request->filfatCode != null) {
            //     $datas = $datas->where('kode_fat', $request->filfatCode);
            // }
            // if($request->filslotTime != null) {
            //     $datas = $datas->where('slot_time', $request->filslotTime);
            // }

            $datas = $datas->groupBy('branch','installation_date')->get();

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button type="button" id="detail-rekapReschedule" name="detail-rekapReschedule" data-id= "'. $row->branch . '" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-0 mb-0 px-1 py-1">
                            <span class="btn-inner--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"></path>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
                                </svg>
                            </span>
                        </button>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return response()->json($request->ajax());
    }
    

    public function getDataPendingReschedule(Request $request)
    {
        $akses = Auth::user()->name;
        
        $datas = DB::table('v_pending_detail');
            // ->get();
        
        // $datas = DB::table('data_pending_reschedules')->leftJoin('')->orderBy('reschedule_date', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('installation_date',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('wo_no', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            // if($request->filtypeWo != null) {
            //     $datas = $datas->where('type_wo', $request->filtypeWo);
            // }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            // if($request->filleaderTim != null) {
            //     $lt = explode("|", $request->filleaderTim);
            //     $ld = $lt[1];
            //     $datas = $datas->where('leader', $ld);
            // }
            // if($request->filcallsignTimid != null) {
            //     $fct = explode("|", $request->filcallsignTimid);
            //     $ct = $fct[1];
            //     $datas = $datas->where('callsign', $ct);
            // }
            // if($request->filteknisi != null) {
            //     $ftk = explode("|", $request->filteknisi );
            //     $nikTk = $ftk[0];
            //     $datas = $datas->where('tek1_nik', $nikTk)
            //                     ->orWhere('tek2_nik', $nikTk)
            //                     ->orWhere('tek3_nik', $nikTk)
            //                     ->orWhere('tek4_nik', $nikTk);
            // }
            // if($request->filcluster != null) {
            //     $datas = $datas->where('cluster', $request->filcluster);
            // }
            // if($request->filfatCode != null) {
            //     $datas = $datas->where('kode_fat', $request->filfatCode);
            // }
            // if($request->filslotTime != null) {
            //     $datas = $datas->where('slot_time', $request->filslotTime);
            // }

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
                    <a href="javascript:void(0)" id="detail-pending" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-pending mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return response()->json($request->ajax());
    }

    

    public function getDetailPending(Request $request)
    {
        // dd($request);
        $pendingId = $request->filPendingID;
        $datas = DB::table('v_pending_detail')
            ->where('id', $pendingId)->first();

        return response()->json($datas);
    }

    public function getDetailCustId(Request $request)
    {

        // dd($request->all());req$request->cust_id)
        // $custId = '22205377';

        $detail_customer = DB::table('v_history_customers')
        ->where('cust_id', $request->cust_id)
        ->get();

        if ($request->ajax()) {

            return DataTables::of($detail_customer)
                ->addIndexColumn() //memberikan penomoran
                // ->editColumn('nama_cust', function ($nm) {
                //     return Str::title($nm->nama_cust);
                // })
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
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->cust_id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return $detail_customer;

        // return response()->json(['data' => $detail_customer]);
        // return view('monitoringWo.detail-customer', compact('detail_customer'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $id = $request->detId;

        $ftthMt = FtthMt::findOrFail($id);

        $updateFtthMt = $ftthMt->update([
            // 'pic_monitoring' => $request[''],
            'type_wo' => $request['woTypeShow'],
            'no_wo' => $request['noWoShow'],
            'no_ticket' => $request['ticketNoShow'],
            'cust_id' => $request['custIdShow'],
            'nama_cust' => $request['custNameShow'],
            'cust_address1' => $request['custAddressShow'],
            // 'cust_address2' => $request[''],
            'type_maintenance' => $request[''],
            'kode_fat' => $request['fatCodeShow'],
            'kode_wilayah' => $request[''],
            'cluster' => $request['cluster'],
            'kotamadya' => $request[''],
            'kotamadya_penagihan' => $request[''],
            'branch' => $request['branchShow'],
            // 'tgl_ikr' => $request[''],
            'slot_time_leader' => $request['slotTimeLeaderShow'],
            'slot_time_apk' => $request['slotTimeAPKShow'],
            'sesi' => $request['sesiShow'],
            'remark_traffic' => $request[''],
            'callsign' => $request[''],
            'leader' => $request['leaderShow'],
            'teknisi1' => $request['teknisi1Show'],
            'teknisi2' => $request['teknisi2Show'],
            'teknisi3' => $request['teknisi3Show'],
            'status_wo' => $request['statusWo'],
            'couse_code' => $request['causeCode'],
            'root_couse' => $request['rootCause'],
            'penagihan' => $request[''],
            'alasan_tag_alarm' => $request[''],
            'tgl_jam_reschedule' => $request['tglReschedule'],
            'tgl_jam_fat_on' => $request[''],
            'action_taken' => $request['actionTaken'],
            'panjang_kabel' => $request[''],
            'weather' => $request['weatherShow'],
            'remark_status' => $request['remarkStatus'],
            'action_status' => $request[''],
            'visit_novisit' => $request[''],
            'start_ikr_wa' => $request[''],
            'end_ikr_wa' => $request[''],
            'validasi_start' => $request[''],
            'validasi_end' => $request[''],
            'checkin_apk' => $request['checkin_apk'],
            'checkout_apk' => $request['checkout_apk'],
            'status_apk' => $request['statusWoApk'],
            'keterangan' => $request[''],
            'ms_regular' => $request[''],
            'wo_date_apk' => $request['WoDateShow'],
            'wo_date_mail_reschedule' => $request[''],
            'wo_date_slot_time_apk' => $request[''],
            'actual_sla_wo_minute_apk' => $request[''],
            'actual_sla_wo_jam_apk' => $request[''],
            'mttr_over_apk_minute' => $request[''],
            'mttr_over_apk_jam' => $request[''],
            'mttr_over_apk_persen' => $request[''],
            'status_sla' => $request[''],
            'root_couse_before' => $request[''],
            'slot_time_assign_apk' => $request[''],
            'slot_time_apk_delay' => $request[''],
            'ket_delay_slot_time' => $request[''],
            'konfirmasi_customer' => $request[''],
            'ont_merk_out' => $request[''],
            'ont_sn_out' => $request[''],
            'ont_mac_out' => $request[''],
            'ont_merk_in' => $request['merkOntIn'],
            'ont_sn_in' => $request[''],
            'ont_mac_in' => $request['macOntIn'],
            'router_merk_out' => $request[''],
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
            'dw_out' => $request[''],
            'precon_out' => $request['kabelPrecon'],
            'bad_precon' => $request[''],
            'fast_connector' => $request[''],
            'patchcord' => $request[''],
            'terminal_box' => $request[''],
            'remote_fiberhome' => $request[''],
            'remote_extrem' => $request[''],
            'port_fat' => $request[''],
            'site_penagihan' => $request[''],
            'konfirmasi_penjadwalan' => $request[''],
            'konfirmasi_cst' => $request[''],
            'konfirmasi_dispatch' => $request[''],
            'remark_status2' => $request[''],
            'wo_type_apk' => $request[''],
            'branch_id' => $request[''],
            'leadcall' => $request[''],
            'tek1_nik' => $request[''],
            'tek2_nik' => $request[''],
            'tek3_nik' => $request[''],
            'tek4_nik' => $request[''],
            'leadcall_id' => $request[''],
            'leader_id' => $request['leaderidShow'],
            'callsign_id' => $request[''],
            'teknisi4' => $request[''],
            'login_id' => $aksesId,
            'login' => $akses,
        ]);

        if ($updateFtthMt) {
            return redirect()->route('monitFtthMT')->with(['success' => 'Data tersimpan.']);
        } else {
            return redirect()->route('monitFtthMT')->with(['error' => 'Gagal Simpan Data.']);
        }
    }
}
