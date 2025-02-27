<?php

namespace App\Http\Controllers;

use App\Exports\FtthIbExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DataAssignTim;
use App\Models\Employee;
use App\Models\FtthIb;
use App\Models\FtthIbMaterial;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MonitFtthIB_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $penagihanIB = DB::table('root_couse_penagihan')->select('status','penagihan')
                    ->where('type_wo','=','IB FTTH')->where('penagihan','<>','total_done')->get();

        $dtDispatch = DB::table('list_dispatch')->get();

        return view('monitoringWo.monit_ftth_ib', compact(
            'branches',
            'leader',
            'callTim',
            'cluster',
            'penagihanIB',
            'dtDispatch',
            'areaFill', 'areagroup'
        ));
    }

    public function getDataIBOris(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        // $datas = DB::table('data_ftth_ib_oris')->orderBy('tgl_ikr', 'DESC');
        $datas = DB::table('data_ftth_ib_oris')->orderBy('tgl_ikr', 'DESC')
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

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
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

                $grupArea = DB::table('branches')->select('grup_area', 'nama_branch')
                            ->where('grup_area', $group)->get();

                $datas = $datas->whereIn('branch', $grupArea->pluck('nama_branch'));


                // $group = $request->filGroup;

                // if ($group == 'Jakarta') {
                //     // Area yang termasuk dalam grup Jabota
                //     $jakartaAreas = ['Jakarta Timur', 'Jakarta Selatan', ];
                //     $datas = $datas->whereIn('branch', $jakartaAreas);
                // } elseif ($group == 'Regional') {
                //     // Area yang termasuk dalam grup Regional
                //     $regionalAreas = ['Bogor', 'Tangerang', 'Bali', 'Bekasi', 'Jambi', 'Medan', 'Palembang', 'Pontianak', 'Pangkal Pinang'];
                //     $datas = $datas->whereIn('branch', $regionalAreas);
                // }
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
                        <svg width="18" height="18" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Detail Material</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-102.000000, -777.000000)" fill="#ffffff"> <path d="M119,797 L130,797 L130,799 L119,799 L119,807 L117,807 L117,799 L106,799 L106,797 L117,797 L117,789 L104,789 L104,805 C104,807.209 105.791,809 108,809 L128,809 C130.209,809 132,807.209 132,805 L132,789 L119,789 L119,797 L119,797 Z M121,783 C119.896,783 119,782.104 119,781 C119,779.896 119.896,779 121,779 C122.104,779 123,779.896 123,781 C123,782.104 122.104,783 121,783 L121,783 Z M115,783 C113.896,783 113,782.104 113,781 C113,779.896 113.896,779 115,779 C116.104,779 117,779.896 117,781 C117,782.104 116.104,783 115,783 L115,783 Z M132,783 L124.445,783 C124.789,782.41 125,781.732 125,781 C125,778.791 123.209,777 121,777 C119.798,777 118.733,777.541 118,778.38 C117.267,777.541 116.202,777 115,777 C112.791,777 111,778.791 111,781 C111,781.732 111.211,782.41 111.555,783 L104,783 C102.896,783 102,783.896 102,785 L102,787 L134,787 L134,785 C134,783.896 133.104,783 132,783 L132,783 Z" id="present" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
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

    public function getSummaryWOIb(Request $request)
    {
        $datas = DB::table('data_ftth_ib_oris');

        if($request->filTgl != null) {
            $dateRange = explode("-", $request->filTgl);
            $startDt = \Carbon\Carbon::parse($dateRange[0]);
            $endDt = \Carbon\Carbon::parse($dateRange[1]);

            $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
        }

        if($request->filGroup == null && $request->filarea != null) {
            $b = explode("|", $request->filarea);
            $br = $b[1];
            $datas = $datas->where('branch', $br);
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

            if ($group == "Jabota") {
                $grupArea = ["Jakarta Timur", "Jakarta Selatan", "Bogor", "Tangerang"];
            } else {
                $grupArea = DB::table('branches')
                    ->where('grup_area', $group)
                    ->pluck('nama_branch') // Ambil langsung sebagai koleksi nilai
                    ->toArray(); // Ubah menjadi array agar bisa digunakan di whereIn()
            }

            $datas = $datas->whereIn('branch', $grupArea);

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

    public function getDetailWOFtthIB(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_ib_oris as d')
            ->where('d.id', $assignId)->first();
        $callsign_tims = DB::table('callsign_tims')->get();
        $callsign_leads = DB::table('callsign_leads as clead')
                ->leftJoin('employees as e','clead.leader_id', '=','e.nik_karyawan')
                ->select('clead.id','clead.lead_callsign','clead.leader_id','e.nama_karyawan')->get();

        $assignTim = DB::table('v_rekap_assign_tim')
                    ->where('tgl_ikr', $datas->tgl_ikr)->get();

        $teknisiOn = DB::table('v_rekap_jadwal_data as vj')
        ->leftJoin('employees as e', 'vj.nik_karyawan', '=', 'e.nik_karyawan')
        ->whereDate('vj.tgl', $datas->tgl_ikr) // Ganti where() dengan whereDate()
        ->where('e.posisi', 'like', '%Teknisi%')
        ->whereIn('vj.status', ["ON", "OD"])
        ->select('vj.nik_karyawan', 'e.nama_karyawan')
        ->orderBy('e.nama_karyawan')
        ->get();


        $wo_no = DB::table('data_ftth_ib_oris')->where('id', $assignId)->value('no_wo'); // contoh WO No


        // Mendapatkan data dari database seperti biasa
        // $ftth_material = DB::table('ftth_ib_materials')
        //     ->where('wo_no', $wo_no)
        //     ->select('wo_no','installation_date','status_item')
        //     ->get()
        //     ->toArray(); // Konversi hasil query ke array

        $ftth_ib_material = DB::table('ftth_ib_materials')
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
            'ftth_ib_material' => $ftth_ib_material,
            'assignTim' => $assignTim,
            'teknisiOn' => $teknisiOn,
        ]);
    }

    public function getMaterialFtthIb(Request $request)
    {
        try {
            // Ambil assignId dari request
            $assignId = $request->filAssignId;

            // Ambil data dari tabel 'data_ftth_ib_oris' berdasarkan assignId
            $datas = DB::table('data_ftth_ib_oris as d')->where('d.id', $assignId)->first();

            // Jika tidak ditemukan, kembalikan respons error
            if (!$datas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            // Ambil nomor WO berdasarkan assignId
            $wo_no = DB::table('data_ftth_ib_oris')->where('id', $assignId)->value('no_wo');

            // Ambil data material berdasarkan nomor WO
            $ftth_ib_material = DB::table('ftth_ib_materials')
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

            // Kembalikan response dalam format JSON
            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $ftth_ib_material,
            ], 200);

        } catch (\Exception $e) {
            // Tangani error dan kembalikan respons JSON
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateFtthIb(Request $request)
    {
        // dd($request->all());
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $id = $request->detId;

        $ftthIb = FtthIb::where('id', $id)->where('no_wo', $request->noWoShow)
                                    ->where('tgl_ikr', $request->tglProgressShow);

        $assignTim = DataAssignTim::where('no_wo_apk', $request->noWoShow)
                                    ->where('tgl_ikr', $request->tglProgressShow)
                                    ->first();

        if($request['LeadCallsignShow']) {
            $LeadCallsignShow = explode("|",$request['LeadCallsignShow']);
            $leadcall_id =  $LeadCallsignShow[0];
            $leadcall = $LeadCallsignShow[1];
            $leader_id = $LeadCallsignShow[2];
            $leader = $LeadCallsignShow[3];
        } else {
            // $LeadCallsignShow = explode("|",$request['LeadCallsignShow']);
            $leadcall_id =  null;
            $leadcall = null;
            $leader_id = null;
            $leader = null;
        }

        if($request['callsignTimidShow']) {
            $callsignTimidShow = explode("|", $request['callsignTimidShow']);
            $callsign_id = $callsignTimidShow[0];
            $callsign = $callsignTimidShow[1];
        } else {
            $callsign_id = null;
            $callsign = null;
        }

        if($request['teknisi1Show']) {
            $teknisi1Show = explode("|", $request['teknisi1Show']);
            $tek1_nik = $teknisi1Show[0];
            $teknisi1 = $teknisi1Show[1];
        } else {
            $tek1_nik = null;
            $teknisi1 = null;
        }

        if($request['teknisi2Show']) {
            $teknisi2Show = explode("|", $request['teknisi2Show']);
            $tek2_nik = $teknisi2Show[0];
            $teknisi2 = $teknisi2Show[1];
        } else {
            $tek2_nik = null;
            $teknisi2 = null;
        }

        if($request['teknisi3Show']) {
            $teknisi3Show = explode("|", $request['teknisi3Show']);
            $tek3_nik = $teknisi3Show[0];
            $teknisi3 = $teknisi3Show[1];
        } else {
            $tek3_nik = null;
            $teknisi3 = null;
        }

        if($request['teknisi4Show']) {
            $teknisi4Show = explode("|", $request['teknisi4Show']);
            $tek4_nik = $teknisi4Show[0];
            $teknisi4 = $teknisi4Show[1];
        } else {
            $tek4_nik = null;
            $teknisi4 = null;
        }

        DB::beginTransaction();
        try {
            $updateFtthIb = $ftthIb->update([
            'type_wo' => $request['woTypeShow'],
            'no_wo' => $request['noWoShow'],
            'no_ticket' => $request['ticketNoShow'],
            'cust_id' => $request['custIdShow'],
            'nama_cust' => $request['custNameShow'],
            'cust_address1' => $request['custAddressShow'],
            'kode_fat' => $request['fatCodeShow'],
            'port_fat' => $request['portFATProgress'],
            'cluster' => $request['areaShow'],
            'branch' => $request['branchShow'],
            'penagihan' => $request['penagihanShow'],
            'tgl_ikr' => $request['tglProgressShow'],
            'slot_time_leader' => $request['slotTimeAPKShow'],
            'slot_time_apk' => $request['slotTimeAPKShow'],
            'sesi' => $request['sesiShow'],
            'waktu_instalasi' => $request['waktuInstallation'],
            'selisih_menit' => $request['statusCheckinMenit'],
            'status_checkin' => $request['statusCheckin'],
            'leader' => $leader,
            'leadcall' => $leadcall,
            'callsign' => $callsign,
            'leader_id' => $leader_id,
            'leadcall_id' => $leadcall_id,
            'callsign_id' => $callsign_id,
            'tek1_nik' => $tek1_nik,
            'tek2_nik' => $tek2_nik,
            'tek3_nik' => $tek3_nik,
            'tek4_nik' => $tek4_nik,
            'teknisi1' => $teknisi1,
            'teknisi2' => $teknisi2,
            'teknisi3' => $teknisi3,
            'teknisi4' => $teknisi4,
            'status_wo' => $request['statusWo'],
            'tgl_jam_reschedule' => $request['jamReschedule'],
            'tgl_reschedule' => $request['tglReschedule'],
            'reason_status' => $request['reasonStatus'],
            'remarks_teknisi' => $request['remarksTeknisi'],
            'weather' => $request['weatherShow'],
            'checkin_apk' => $request['tglCheckinApk'],
            'checkout_apk' => $request['tglCheckoutApk'],
            'status_apk' => $request['statusWoApk'],
            'qty_material_out' => $request['materialOut'],
            'qty_material_in' => $request['materialIn'],
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
            'telp_dispatch' => $request['telp_dispatch'],
            'nama_dispatch' => $request['picDispatch'],
            'detail_alasan' => $request['detailAlasan'],
            'alasan_pending' => $request['alasanPending'],
            'alasan_cancel' => $request['alasanCancel'],
            'validasi_start' => $request['validasi_start'],
            'validasi_end' => $request['validasi_end'],
            'start_regist' => $request['start_regist'],
            'end_regist' => $request['end_regist'],
            'respon_konf_cst' => $request['respon_konf_cst'],
            'jawaban_konf_cst' => $request['jawaban_konf_cst'],
            'permintaan_reschedule' => $request['permintaan_reschedule'],
            'start_ikr_wa' => $request['start_ikr_wa'],
            'end_ikr_wa' => $request['end_ikr_wa'],
            'jam_teknisi_aktifasi_perangkat' => $request['jam_teknisi_aktifasi_perangkat'],
            'jam_dispatch_respon_aktifasi_perangkat' => $request['jam_dispatch_respon_aktifasi_perangkat'],
            'jam_tek_foto_rmh' => $request['jam_tek_foto_rmh'],
            'jam_dispatch_respon_foto' => $request['jam_dispatch_respon_foto'],
            'otp_start' => $request['otp_start'],
            'otp_end' => $request['otp_end'],
            'is_checked' => $request['is_checked'],
            'login' => $akses,
        ]);

        $assignTim = $assignTim->update([
                'slot_time' => $request['slotTimeAPKStatusShow'],
                'time_apk' => $request['slotTimeAPKStatusShow'],
                'leadcall_id' => $leadcall_id,
                'leadcall' => $leadcall,
                'leader_id' => $leader_id,
                'leader' => $leader,
                'callsign_id' => $callsign_id,
                'callsign' => $callsign,
                'tek1_nik' => $tek1_nik,
                'teknisi1' => $teknisi1,
                'tek2_nik' => $tek2_nik,
                'teknisi2' => $teknisi2,
                'tek3_nik' => $tek3_nik,
                'teknisi3' => $teknisi3,
                'tek4_nik' => $tek4_nik,
                'teknisi4' => $teknisi4
            ]);

            DB::commit();

            if ($updateFtthIb && $assignTim) {
                // return redirect()->route('monitFtthIB')->with(['success' => 'Data tersimpan.']);
                return response()->json('success');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e;
            // dd($e);
            // return redirect()->route('monitFtthIB')->with(['error' => 'Gagal Simpan Data.']);
            return response()->json($e->getMessage());
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
        $export = new FtthIbExport($request);
        return Excel::download($export, 'FTTH_IB.xlsx');
    }

    public function editMaterialIb(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('ftth_ib_materials as d')
            ->where('d.id', $assignId)->first();

        return response()->json($datas);
    }

    public function updateMaterialIb(Request $request)
    {
        // dd($request->all());
        $id = $request->detId;

        $material_mt = FtthIbMaterial::findOrFail($id);

        $material_mt->update([
            'status_item' => $request['status_item'],
            'item_code' => $request['item_code'],
            'qty' => $request['qty'],
            'sn' => $request['sn'],
            'mac_address' => $request['mac_address'],
            'description' => $request['description'],

        ]);

        return redirect()->route('monitFtthIB')
            ->with('success', 'Berhasil mengubah data material New Installation');
    }

    public function updateConfirmation(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
            'data.*.id' => 'required|integer|exists:data_ftth_ib_oris,id',
            'data.*.is_confirmation' => 'required|in:0,1'
        ]);

        foreach ($request->data as $item) {
            FtthIb::where('id', $item['id'])->update([
                'is_confirmation' => $item['is_confirmation']
            ]);
        }

        return response()->json(['message' => 'Konfirmasi diperbarui!']);
    }


}
