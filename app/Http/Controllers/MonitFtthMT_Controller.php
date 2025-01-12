<?php

namespace App\Http\Controllers;

use App\Exports\FtthMtExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DataAssignTim;
use App\Models\Employee;
use App\Models\FtthMaterial;
use App\Models\FtthMt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class MonitFtthMT_Controller extends Controller
{

    public function index()
    {
        $branches = DB::table('branches')->select('id','nama_branch')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $leader = DB::table('v_detail_callsign_tim')->select('leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        $cluster = DB::table('fats')->select('cluster')
                ->where('cluster', '<>', "")->distinct()->orderBy('cluster')->get();

        $mostCauseCode = FtthMt::select(
                    'couse_code',
                    DB::raw('COUNT(couse_code) AS qtyCauseCode')
                )
                ->groupBy('couse_code') // Tambahkan groupBy di sini
                ->orderBy('qtyCauseCode', 'desc')
                ->limit(5)
                ->get();

        $mostRootCause = FtthMt::select(
            'root_couse',
                DB::raw('COUNT(root_couse) AS qtyRootCause')
            )
            ->groupBy('root_couse') ->orderBy('qtyRootCause','desc')
            ->limit(5)
            ->get();

        $mostActionTaken = FtthMt::select(
            'action_taken',
                DB::raw('COUNT(action_taken) AS qtyActionTaken')
            )
            ->groupBy('action_taken') ->orderBy('qtyActionTaken','desc')
            ->limit(5)
            ->get();

        $dtCouseCode = DB::table('root_couses')
                ->select('status_wo','couse_code')
                ->groupBy('status_wo','couse_code')
                ->orderBy('couse_code')->get();

        $dtRootCouse = DB::table('root_couses')
                ->select('couse_code', 'root_couse')
                ->groupBy('couse_code', 'root_couse')
                ->orderBy('root_couse')->get();

        $dtActionTaken = DB::table('root_couses')
                ->select('root_couse', 'action_taken')
                ->groupBy('root_couse', 'action_taken')
                ->orderBy('action_taken')->get();

        $dtPenagihan = DB::table('root_couses')
                ->select('status_wo','couse_code', 'root_couse', 'action_taken','rootcouse_penagihan')
                ->groupBy('status_wo','couse_code', 'root_couse', 'action_taken','rootcouse_penagihan')
                ->orderBy('rootcouse_penagihan')->get();

        return view('monitoringWo.monit_ftth_mt', compact(
            'mostCauseCode',
            'mostRootCause',
            'mostActionTaken',
            'branches',
            'leader',
            'callTim',
            'cluster',
            'dtCouseCode','dtRootCouse','dtActionTaken','dtPenagihan'
        ));
    }

    public function getSummaryWO(Request $request)
    {
        $datas = DB::table('data_ftth_mt_oris');

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

            if ($group == 'Jakarta') {
                $jakartaAreas = ['Jakarta Timur', 'Jakarta Selatan'];
                $datas = $datas->whereIn('branch', $jakartaAreas);
            } elseif ($group == 'Regional') {
                $regionalAreas = ['Bali', 'Bekasi', 'Bogor', 'Tangerang', 'Jambi', 'Medan', 'Palembang', 'Pontianak', 'Pangkal Pinang'];
                $datas = $datas->whereIn('branch', $regionalAreas);
            }
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

    public function getDataMTOris(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        $datas = DB::table('data_ftth_mt_oris')->orderBy('tgl_ikr', 'DESC')
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

                if ($group == 'Jakarta') {
                    // Area yang termasuk dalam grup Jabota
                    $jakartaAreas = ['Jakarta Timur', 'Jakarta Selatan', ];
                    $datas = $datas->whereIn('branch', $jakartaAreas);
                } elseif ($group == 'Regional') {
                    // Area yang termasuk dalam grup Regional
                    $regionalAreas = ['Bogor', 'Tangerang', 'Bali', 'Bekasi', 'Jambi', 'Medan', 'Palembang', 'Pontianak', 'Pangkal Pinang'];
                    $datas = $datas->whereIn('branch', $regionalAreas);
                }
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
                        class="btn btn-sm btn-primary detail-assign mb-0 tooltip-info" data-rel="tooltip" title="Detail WO">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                        </svg>
                    </a>
                    <a href="javascript:void(0)"
                        id="detail-material"
                        data-id="' . $row->id . '"
                        class="btn btn-sm btn-secondary detail-material mb-0 tooltip-info" data-rel="tooltip" title="Detail Material">
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


    public function getDetailWOFtthMT(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_mt_oris as d')
            ->where('d.id', $assignId)->first();
        $callsign_tims = DB::table('callsign_tims')->get();
        $callsign_leads = DB::table('callsign_leads')->get();

        // $wo_no = DB::table('data_ftth_mt_oris')->where('id', $assignId)->value('no_wo'); // contoh WO No

        // Mendapatkan data dari database seperti biasa
        $ftth_material = DB::table('ftth_materials')
            ->where('wo_no', $datas->no_wo)
            ->select(
                'wo_no',
                'installation_date',
                'status_item',
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "ONT" THEN description END AS merk_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "ONT" THEN sn END AS sn_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "ONT" THEN mac_address END AS mac_ont_out'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "ONT" THEN description END AS merk_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "ONT" THEN sn END AS sn_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "ONT" THEN mac_address END AS mac_ont_in'),

                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "STB" THEN description END AS merk_stb_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "STB" THEN sn END AS sn_stb_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "STB" THEN mac_address END AS mac_stb_out'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "STB" THEN description END AS merk_stb_in'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "STB" THEN sn END AS sn_stb_in'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "STB" THEN mac_address END AS mac_stb_in'),

                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Router" THEN description END AS merk_router_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Router" THEN sn END AS sn_router_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Router" THEN mac_address END AS mac_router_out'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "Router" THEN description END AS merk_router_in'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "Router" THEN sn END AS sn_router_in'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "Router" THEN mac_address END AS mac_router_in'),

                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Remote" THEN description END AS remote_out'),
                DB::raw('CASE WHEN status_item = "IN" AND kategori_material = "Remote" THEN description END AS remote_in'),

                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "DW" THEN qty END AS dw_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Precon" THEN description END AS precon_out'),

                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Fast Connector" THEN qty END AS fastcon_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Patchcord" THEN qty END AS patchcord_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Terminal Box" THEN qty END AS tb_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "PVC Pipe" THEN qty END AS pvc_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "Socket Pipe" THEN qty END AS socket_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "UTP" THEN qty END AS utp_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND kategori_material = "RJ45" THEN qty END AS rj45_out'),

            )
            ->get()
            ->toArray(); // Konversi hasil query ke array

        // Fungsi untuk menggabungkan data dari beberapa array menjadi satu array
        function mergeFtthMaterials($materials) {
            $result = [];

            foreach ($materials as $material) {
                foreach ($material as $key => $value) {
                    // Jika key belum ada di $result atau nilainya masih null, isi dengan data baru
                    if (!isset($result[$key]) || $result[$key] === null) {
                        $result[$key] = $value;
                    }
                }
            }

            return $result;
        }

        // Gabungkan data ftth_material menjadi satu array
        $mergedMaterial = mergeFtthMaterials($ftth_material);

        // dd($datas);
        // Mengirimkan response JSON
        return response()->json([
            'data' => $datas,
            'callsign_tims' => $callsign_tims,
            'callsign_leads' => $callsign_leads,
            'ftth_material' => $mergedMaterial
        ]);

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

    public function getMaterialFtthMt(Request $request)
    {
        try {
            // Ambil assignId dari request
            $assignId = $request->filAssignId;

            // Ambil data dari tabel 'data_ftth_mt_oris' berdasarkan assignId
            $datas = DB::table('data_ftth_mt_oris as d')->where('d.id', $assignId)->first();

            // Jika tidak ditemukan, kembalikan respons error
            if (!$datas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            // Ambil nomor WO berdasarkan assignId
            $wo_no = DB::table('data_ftth_mt_oris')->where('id', $assignId)->value('no_wo');

            // Ambil data material berdasarkan nomor WO
            $ftth_mt_material = DB::table('ftth_materials')
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
                'data' => $ftth_mt_material,
            ], 200);

        } catch (\Exception $e) {
            // Tangani error dan kembalikan respons JSON
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $id = $request->detId;

        $ftthMt = FtthMt::findOrFail($id);
        $assignTim = DataAssignTim::where('leadcall_id', $ftthMt->leadcall_id)->first();

        DB::beginTransaction();
        try {
            $updateFtthMt = $ftthMt->update([
                'pic_monitoring' => $akses,
                // 'type_wo' => $request['jenisWoShow'],
                'no_wo' => $request['noWoShow'],
                'no_ticket' => $request['ticketNoShow'],
                'cust_id' => $request['custIdShow'],
                'nama_cust' => $request['custNameShow'],
                'cust_address1' => $request['custAddressShow'],
                // 'cust_address2' => $request[''],
                // 'type_maintenance' => $request[''],
                'kode_fat' => $request['fatCodeShow'],
                // 'kode_wilayah' => $request[''],
                'cluster' => $request['cluster'],
                // 'kotamadya' => $request[''],
                // 'kotamadya_penagihan' => $request[''],
                'branch' => $request['branchShow'],
                'tgl_ikr' => $request['tglProgressShow'],
                'slot_time_leader' => $request['slotTimeLeaderShow'],
                'slot_time_apk' => $request['slotTimeAPKShow'],
                'sesi' => $request['sesiShow'],
                // 'remark_traffic' => $request[''],
                // 'callsign' => $request[''],
                'leader' => $request['leaderShow'],
                'teknisi1' => $request['teknisi1Show'],
                'teknisi2' => $request['teknisi2Show'],
                'teknisi3' => $request['teknisi3Show'],
                'status_wo' => $request['statusWo'],
                'couse_code' => $request['causeCode'],
                'root_couse' => $request['rootCause'],
                'action_taken' => $request['actionTaken'],
                'penagihan' => $request['penagihanShow'],
                // 'alasan_tag_alarm' => $request[''],
                'tgl_reschedule' => $request['tglReschedule'],
                'tgl_jam_reschedule' => $request['tglJamReschedule'],
                // 'tgl_jam_fat_on' => $request[''],
                // 'panjang_kabel' => $request[''],
                'weather' => $request['weatherShow'],
                'remark_status' => $request['remarkStatus'],
                // 'action_status' => $request[''],
                'visit_novisit' => $request['statusVisit'],
                // 'start_ikr_wa' => $request[''],
                // 'end_ikr_wa' => $request[''],
                'validasi_start' => $request['validasiStart'],
                'validasi_end' => $request['validasiEnd'],
                'checkin_apk' => $request['tglCheckinApk'],
                'checkout_apk' => $request['checkout_apk'],
                'status_apk' => $request['statusWoApk'],
                // 'keterangan' => $request[''],
                // 'ms_regular' => $request[''],
                'wo_date_apk' => $request['WoDateShow'],
                // 'wo_date_mail_reschedule' => $request[''],
                // 'wo_date_slot_time_apk' => $request[''],
                // 'actual_sla_wo_minute_apk' => $request[''],
                // 'actual_sla_wo_jam_apk' => $request[''],
                // 'mttr_over_apk_minute' => $request[''],
                // 'mttr_over_apk_jam' => $request[''],
                // 'mttr_over_apk_persen' => $request[''],
                // 'status_sla' => $request[''],
                // 'root_couse_before' => $request[''],
                // 'slot_time_assign_apk' => $request[''],
                // 'slot_time_apk_delay' => $request[''],
                // 'ket_delay_slot_time' => $request[''],
                // 'konfirmasi_customer' => $request[''],
                'ont_merk_out' => $request['ont_merk_out'],
                'ont_sn_out' => $request['snOntOut'],
                // 'ont_mac_out' => $request[''],
                'ont_merk_in' => $request['merkOntIn'],
                // 'ont_sn_in' => $request[''],
                'ont_mac_in' => $request['macOntIn'],
                // 'router_merk_out' => $request[''],
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
                // 'dw_out' => $request[''],
                'precon_out' => $request['kabelPrecon'],
                // 'bad_precon' => $request[''],
                'fastcon_out' => $request['fastConnector'],
                'patchcord_out' => $request['patchCord'],
                // 'terminal_box' => $request[''],
                // 'remote_fiberhome' => $request[''],
                // 'remote_extrem' => $request[''],
                // 'port_fat' => $request[''],
                // 'site_penagihan' => $request[''],
                // 'konfirmasi_penjadwalan' => $request[''],
                // 'konfirmasi_cst' => $request[''],
                // 'konfirmasi_dispatch' => $request[''],
                // 'remark_status2' => $request[''],
                // 'wo_type_apk' => $request[''],
                // 'branch_id' => $request[''],
                // 'leadcall' => $request['LeadCallsignShow'],
                // 'tek1_nik' => $request[''],
                // 'tek2_nik' => $request[''],
                // 'tek3_nik' => $request[''],
                // 'tek4_nik' => $request[''],
                'leadcall_id' => $request['LeadCallsignShow'],
                'dispatch' => $request['picDispatch'],
                'leader_id' => $request['leaderidShow'],
                'callsign_id' => $request['callsign_id'],
                'alasan_tidak_ganti_precon' => $request['alasan_tidak_ganti_precon'],
                'alasan_pending' => $request['alasan_pending'],
                'alasan_cancel' => $request['alasan_cancel'],
                'keterangan' => $request['report_teknisi'],
                'is_checked' => $request['is_checked'],
                'teknisi4' => $request[''],
                'login_id' => $aksesId,
                'login' => $akses,
            ]);

            $assignTim = $assignTim->update([
                'leadcall_id' => $request['LeadCallsignShow'],
            ]);

            DB::commit();

            if ($updateFtthMt && $assignTim) {
                // return redirect()->route('monitFtthMT')->with(['success' => 'Data tersimpan.']);
                return response()->json('success');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            // return redirect()->route('monitFtthMT')->with(['error' => 'Gagal Simpan Data.']);
            return response()->json($e->getMessage());

        }
    }

    public function export(Request $request)
    {
        $export = new FtthMtExport($request);
        return Excel::download($export, 'FTTH_MT.xlsx');
    }

    public function editMaterial(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('ftth_materials as d')
            ->where('d.id', $assignId)->first();

        return response()->json($datas);
    }

    public function updateMaterialMt(Request $request)
    {
        // dd($request->all());
        $id = $request->detId;

        $material_mt = FtthMaterial::findOrFail($id);

        $material_mt->update([
            'status_item' => $request['status_item'],
            'item_code' => $request['item_code'],
            'qty' => $request['qty'],
            'sn' => $request['sn'],
            'mac_address' => $request['mac_address'],
            'description' => $request['description'],

        ]);

        return redirect()->route('monitFtthMT')
            ->with('success', 'Berhasil mengubah data material maintenance');
    }

}
