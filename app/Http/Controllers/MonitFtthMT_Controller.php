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

        // $mostCauseCode = FtthMt::select(
        //             'couse_code',
        //             DB::raw('COUNT(couse_code) AS qtyCauseCode')
        //         )
        //         ->groupBy('couse_code') // Tambahkan groupBy di sini
        //         ->orderBy('qtyCauseCode', 'desc')
        //         ->limit(5)
        //         ->get();

        // $mostRootCause = FtthMt::select(
        //     'root_couse',
        //         DB::raw('COUNT(root_couse) AS qtyRootCause')
        //     )
        //     ->groupBy('root_couse') ->orderBy('qtyRootCause','desc')
        //     ->limit(5)
        //     ->get();

        // $mostActionTaken = FtthMt::select(
        //     'action_taken',
        //         DB::raw('COUNT(action_taken) AS qtyActionTaken')
        //     )
        //     ->groupBy('action_taken') ->orderBy('qtyActionTaken','desc')
        //     ->limit(5)
        //     ->get();

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
        
        $dtPenagihanAll = DB::table('root_couse_penagihan')
                ->select('status as status_wo','penagihan as rootcouse_penagihan')
                ->where('type_wo', "MT FTTH")
                ->where('penagihan','not like', '%total_%')
                ->orderBy('penagihan')->get();

        $dtDispatch = DB::table('list_dispatch')->get();

        return view('monitoringWo.monit_ftth_mt', compact(
            // 'mostCauseCode',
            // 'mostRootCause',
            // 'mostActionTaken',
            'branches',
            'leader',
            'callTim',
            'cluster',
            'dtCouseCode',
            'dtRootCouse',
            'dtActionTaken',
            'dtPenagihan', 
            'dtPenagihanAll',
            'dtDispatch'
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
                $regionalAreas = ['Bekasi', 'Bogor', 'Tangerang', 'Medan', 'Pangkal Pinang', 'Pontianak', 'Jambi', 'Bali', 'Palembang', 'Pekanbaru', 'Serang', 'Cirebon', 'Semarang'];
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
                    count(if((status_wo="Requested") || (status_wo is null),1,null)) as requested ')
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

                $grupArea = DB::table('branches')->select('grup_area', 'nama_branch')
                            ->where('grup_area', $group)->get();

                $datas = $datas->whereIn('branch', $grupArea->pluck('nama_branch'));

                // if ($group == 'Jakarta') {
                    // Area yang termasuk dalam grup Jabota
                    // $jakartaAreas = ['Jakarta Timur', 'Jakarta Selatan', ];
                    // $datas = $datas->whereIn('branch', $jakartaAreas));
                // } elseif ($group == 'Regional') {
                    // Area yang termasuk dalam grup Regional
                    // $regionalAreas = ['Bogor', 'Tangerang', 'Bali', 'Bekasi', 'Jambi', 'Medan', 'Palembang', 'Pontianak', 'Pangkal Pinang'];
                    // $datas = $datas->whereIn('branch', $regionalAreas);
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

                        <span class="badge text-bg-danger text-white"></span>
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
        $akses = Auth::user()->name;

        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_mt_oris as d')
            ->where('d.id', $assignId)->first();

        

        $callLead = DB::table('callsign_leads as cl')
                    ->select('id','lead_callsign as callsign_tim')->orderBy('lead_callsign');

        $callsign_tims = DB::table('callsign_tims')
                    ->select('id','callsign_tim')
                    ->union($callLead)
                    ->orderBy('callsign_tim')->get();
        // dd($callsign_tims);

        $callsign_leads = DB::table('callsign_leads as clead')
                ->leftJoin('employees as e','clead.leader_id', '=','e.nik_karyawan')
                ->select('clead.id','clead.lead_callsign','clead.leader_id','e.nama_karyawan')->get();

        $assignTim = DB::table('v_rekap_assign_tim')
                    ->where('tgl_ikr', $datas->tgl_ikr)->get();

        $teknisiOn = DB::table('v_rekap_jadwal_data as vj')
                    ->leftJoin('employees as e','vj.nik_karyawan','=','e.nik_karyawan')
                    ->whereDate('vj.tgl', $datas->tgl_ikr)
                    // ->where('e.posisi', 'like','%Teknisi%')
                    ->whereRaw('(e.posisi like "%Teknisi%" or e.posisi like "%Leader%")')
                    ->whereIn('vj.status', ["ON","OD"])
                    ->select('vj.nik_karyawan', 'e.nama_karyawan')
                    ->orderBy('e.nama_karyawan')->get();

        // $wo_no = DB::table('data_ftth_mt_oris')->where('id', $assignId)->value('no_wo'); // contoh WO No

        // Mendapatkan data dari database seperti biasa
        $ftth_material = DB::table('ftth_materials')
            ->where('wo_no', $datas->no_wo)
            ->select('wo_no','installation_date','status_item')
            ->get()
            ->toArray(); // Konversi hasil query ke array

        // Fungsi untuk menggabungkan data dari beberapa array menjadi satu array
        // function mergeFtthMaterials($materials) {
        //     $result = [];

        //     foreach ($materials as $material) {
        //         foreach ($material as $key => $value) {
        //             // Jika key belum ada di $result atau nilainya masih null, isi dengan data baru
        //             if (!isset($result[$key]) || $result[$key] === null) {
        //                 $result[$key] = $value;
        //             }
        //         }
        //     }

        //     return $result;
        // }

        // Gabungkan data ftth_material menjadi satu array
        // $mergedMaterial = mergeFtthMaterials($ftth_material);
        $mergedMaterial = $ftth_material;

        // dd($datas);
        // Mengirimkan response JSON
        return response()->json([
            'data' => $datas,
            'callsign_tims' => $callsign_tims,
            'callsign_leads' => $callsign_leads,
            'ftth_material' => $mergedMaterial,
            'assignTim' => $assignTim,
            'teknisiOn' => $teknisiOn,
            'akses' => $akses
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
        // dd($request['is_checked'], $request->input('is_checked'), $request['isChecked'], $request->input('isChecked'), );
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $id = $request->detId;

        if($request['is_checked'] == "1") {
            $pic = $akses;
            $check = 1;
        } else {
            $pic = null;
            $check = 0;
        }

        $ftthMt = FtthMt::findOrFail($id);
        $assignTim = DataAssignTim::where('no_wo_apk', $ftthMt->no_wo)
                                    ->where('tgl_ikr', $ftthMt->tgl_ikr)->first();
                                    // ->where('leadcall_id', $ftthMt->leadcall_id)->first();

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
            $updateFtthMt = $ftthMt->update([
                // 'no_wo' => $request['noWoShow'],
                // 'no_ticket' => $request['ticketNoShow'],
                // 'cust_id' => $request['custIdShow'],
                // 'nama_cust' => $request['custNameShow'],
                'pic_monitoring' => $pic, //1
                'type_wo' => $request['jenisWoShow'], //1
                'wo_date_apk' => $request['WoDateShow'], //1
                'branch' => $request['branchShow'], //1
                'kotamadya' => $request['kotamadyaShow'], //1
                'cluster' => $request['cluster'],  //1
                'kotamadya_penagihan' => $request['kotaPenagihanShow'], //1
                'site_penagihan' => $request['sitePenagihan'], //1
                'sesi' => $request['sesiDetShow'], //1
                'callsign_id' => $callsign_id, //1
                'callsign' => $callsign,  //1
                'leadcall_id' => $leadcall_id, //1
                'leadcall' => $leadcall, //1
                'leader_id' => $leader_id, //1
                'leader' => $leader, //1
                'tek1_nik' => $tek1_nik, //1
                'tek2_nik' => $tek2_nik, //1
                'tek3_nik' => $tek3_nik, //1
                'tek4_nik' => $tek4_nik, //1
                'teknisi1' => $teknisi1, //1
                'teknisi2' => $teknisi2, //1
                'teknisi3' => $teknisi3, //1
                'teknisi4' => $teknisi4, //1
                'slot_time_leader' => $request['slotTimeAPKStatusShow'], //1
                'slot_time_apk' => $request['slotTimeAPKStatusShow'], //1
                'checkin_apk' => $request['tglCheckinApk'], //1
                'checkout_apk' => $request['tglCheckoutApk'], //1
                'status_apk' => $request['statusWoApk'], //1
                'status_wo' => $request['statusWo'], //1
                'couse_code' => $request['causeCode'],  //1
                'root_couse' => $request['rootCause'], //1
                'action_taken' => $request['actionTaken'], //1
                'penagihan' => $request['penagihanShow'], //1
                'keterangan' => $request['reportTeknisi'], //1
                'minute' => $request['statusCheckinMenit'], //1
                'status_checkin' => $request['statusCheckin'], //1
                'waktu_installation' => $request['waktuInstallation'], //1
                'visit_novisit' => $request['statusVisit'], //1
                'action_status' => $request['actionStatus'], //1
                'bad_precon' => $request['preconBad'], //1
                'tgl_reschedule' => $request['tglReschedule'], //11
                'tgl_jam_reschedule' => $request['tglJamReschedule'], //1
                'permintaan_rsch' => $request['permintaanReschedule'], //1
                'respon_cst' => $request['responKonfCst'], //1
                'jawaban_cst' => $request['jwbKonfCst'], //1
                'weather' => $request['weatherShow'], //1
                'dispatch' => $request['picDispatch'], //1
                'telp_dispatch' => $request['telpDispatch'], //1
                'detail_alasan' => $request['detailAlasan'], //1
                'validasi_start' => $request['validasiStart'], //1
                'validasi_end' => $request['validasiEnd'], //1
                'regist_start' => $request['registStart'], //1
                'regist_end' => $request['registEnd'], //1
                'kode_otp' => $request['kodeOtp'], //1
                'cek_telebot' => $request['cekTelebot'], //1
                'hasil_cek_telebot' => $request['hasilCekTelebot'], //1
                'mttr_all' => $request['mttrAll'], //1
                'mttr_pending' => $request['mttrPending'], //1
                'mttr_progress' => $request['mttrProgress'], //1
                'mttr_teknisi' => $request['mttrTeknisi'],  //1
                'sla_over' => $request['slaOver'], //1
                'material_out' => $request['materialOut'], //1
                'material_in' => $request['materialIn'], //1          
                'is_checked' => $check, //1
                'login_id' => $aksesId,
                'login' => $akses,
                
                
                // 'cust_address1' => $request['custAddressShow'],
                // 'cust_address2' => $request[''],
                // 'type_maintenance' => $request['remarkStatus'],
                // 'kode_fat' => $request['fatCodeShow'],
                // 'kode_wilayah' => $request[''],
                // 'tgl_ikr' => $request['tglProgressAPKShow'],
                // 'remark_traffic' => $request[''],
                // 'alasan_tag_alarm' => $request['alasanTidakGantiPrecon'],                
                // 'alasan_pending' => $request['alasan_pending'],
                // 'start_ikr_wa' => $request['statusStartIkrWa'],
                // 'end_ikr_wa' => $request['statusEndIkrWa'],
                // 'foto_rumah' => $request['fotoRumah'],
                // 'foto_selfie' => $request['fotoSelfie'],
                // 'kondisi_fat' => $request['kondisiFat'],
                // 'tgl_jam_fat_on' => $request[''],
                // 'panjang_kabel' => $request[''],
                // 'remark_status' => $request['statusPrecon'],
                // 'ms_regular' => "Manage Service",
                
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
                // 'ont_merk_out' => $request['ont_merk_out'],
                // 'ont_sn_out' => $request['snOntOut'],
                // 'ont_mac_out' => $request[''],
                // 'ont_merk_in' => $request['merkOntIn'],
                // 'ont_sn_in' => $request[''],
                // 'ont_mac_in' => $request['macOntIn'],
                // 'router_merk_out' => $request[''],
                // 'router_sn_out' => $request['snRouterOut'],
                // 'router_mac_out' => $request['macRouterOut'],
                // 'router_merk_in' => $request['merkRouterIn'],
                // 'router_sn_in' => $request['snRouterIn'],
                // 'router_mac_in' => $request['macRouterIn'],
                // 'stb_merk_out' => $request['merkStbOut'],
                // 'stb_sn_out' => $request['snStbOut'],
                // 'stb_mac_out' => $request['macStbOut'],
                // 'stb_merk_in' => $request['merkStbIn'],
                // 'stb_sn_in' => $request['snStbIn'],
                // 'stb_mac_in' => $request['macStbIn'],
                // 'dw_out' => $request[''],
                // 'precon_out' => $request['kabelPrecon'],                
                // 'fastcon_out' => $request['fastConnector'],
                // 'patchcord_out' => $request['patchCord'],
                // 'terminal_box' => $request[''],
                // 'remote_fiberhome' => $request[''],
                // 'remote_extrem' => $request[''],
                // 'port_fat' => $request[''],
                
                // 'konfirmasi_penjadwalan' => $request[''],
                // 'konfirmasi_cst' => $request[''],
                // 'konfirmasi_dispatch' => $request[''],
                // 'remark_status2' => $request[''],
                // 'wo_type_apk' => $request[''],
                // 'branch_id' => $request[''],
                
                
                
                // 'alasan_tidak_ganti_precon' => $request['alasan_tidak_ganti_precon'],
                
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
