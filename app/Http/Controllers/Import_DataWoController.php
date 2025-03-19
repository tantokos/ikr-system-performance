<?php

namespace App\Http\Controllers;

use App\Imports\AssignWoImport;
use App\Models\DataAssignTim;
use App\Models\Employee;
use App\Models\FtthDismantle;
use App\Models\FtthIb;
use App\Models\FtthMt;
use App\Models\ImportAssignTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class Import_DataWoController extends Controller
{
    public function index(Request $request)
    {
        $akses = Auth::user()->name;
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_assign_tims')->where('login', '=', $akses)->count('login');

        $callsigns = DB::table('import_assign_tims')
        ->select('callsign', 'branch_id','branch', 'type_wo', DB::raw('count(*) as total_wo'))
        ->where('login', $akses)
        ->groupBy('callsign', 'type_wo','branch_id', 'branch')
        ->orderBy('branch_id')
        ->orderBy('callsign')
        ->get();


        $pivotData = [];
        $totalFtthNewInstallation = 0;
        $totalFtthMt = 0;
        $totalDismantle = 0;
        $totalFttxIb = 0;

        foreach ($callsigns as $item) {
            $area = $item->branch;
            $callsign = $item->callsign;
            $type_wo = $item->type_wo;

            // Inisialisasi array jika belum ada
            if (!isset($pivotData[$callsign])) {
                $pivotData[$callsign] = [
                    'area' => $area,
                    'callsign' => $callsign,
                    'FTTH New Installation' => 0,
                    'FTTH Maintenance' => 0,
                    'FTTH Dismantle' => 0,
                    'FTTX New Installation' => 0,
                    'FTTX Maintenance' => 0,
                    'Total WO' => 0
                ];
            }

            // Tambahkan nilai total_wo ke type_wo yang sesuai
            $pivotData[$callsign][$type_wo] = $item->total_wo;

            if($type_wo == 'FTTH New Installation'){
                $totalFtthNewInstallation += $item->total_wo;
            }

            if($type_wo == 'FTTH Maintenance'){
                $totalFtthMt += $item->total_wo;
            }

            if($type_wo == 'FTTH Dismantle'){
                $totalDismantle += $item->total_wo;
            }

            if($type_wo == 'FTTX New Installation'){
                $totalFttxIb += $item->total_wo;
            }

            // Tambahkan ke total WO
            $pivotData[$callsign]['Total WO'] += $item->total_wo;
        }

        // return $pivotData;
        return view('assign.import-DataWO', [
            'branches' => $branches,
            'leadCallsign' => $Leadcallsign,
            'akses' => $akses,
            'brImport' => $request->brImport,
            'callsigns' => $callsigns,
            'pivotData' => $pivotData,
            'totalFtthNewInstallation' => $totalFtthNewInstallation,
            'totalFtthMt' => $totalFtthMt,
            'totalDismantle' => $totalDismantle,
            'totalFttxIb' => $totalFttxIb,
        ]);
    }



    public function import()
    {
        $headings = (new HeadingRowImport)->toArray('users.xlsx');
    }


    public function importProsesDataWo(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');

        if ($request->hasFile('fileDataWO')) {
            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;


            // $dtJadwal = DB::table('employees as e')->select('vj.tgl','vj.nik_karyawan','e.nama_karyawan')
            //                     ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
            //                     ->where('e.status_active','=','Aktif')
            //                     ->whereIn('vj.status', ["ON","OD"])->get();

                                // ->where('vj.tgl', $tanggal)
                                // ->first();
            $dtKry = DB::table('employees as e')->select('e.nik_karyawan','e.nama_karyawan')
                        ->where('e.status_active','=','Aktif')
                        ->whereRaw('(e.posisi like "%Teknisi%" OR e.posisi like "%Leader%")')->get();

            $dtBranch = DB::table('branches')->select('id','nama_branch')->get();
            $dtCallsignTim = DB::table('v_detail_callsign_tim')->get();
            $dtCallsignLead = DB::table('callsign_leads as cl')
                            ->leftJoin('employees as e','cl.leader_id', '=', 'e.nik_karyawan')
                            ->select('cl.id as callsign_tim_id', 'cl.lead_callsign')->get();
                            // ->where('lead_callsign', $data)->first();

            $dttp_wo = DB::table('type_wo')->select('type_wo', 'type_wo_apk')->get();
            // dd($dttp_wo);
            $dtcluster = DB::table('list_fat')->select('cluster','kode_area','kategori_area')->get();

            DB::beginTransaction();
            
            try {
                try {
                    Excel::import(new AssignWoImport($akses, $dttp_wo, $dtcluster, $dtKry, $dtBranch, $dtCallsignTim, $dtCallsignLead), $request->file('fileDataWO'));

                    DB::commit();
                    return back()->with(['success' => 'Import Work Order berhasil.']);
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    DB::rollBack();
                    $failures = $e->failures();
                    // dd($e);
                    $errorMessages = [];
                    foreach ($failures as $failure) {
                        // dd($failure->values()[$failure->attribute()]);
                        $errorMessages[] = "Baris " . $failure->row() . " (" . $failure->attribute() . ") = " . "'" . $failure->values()[$failure->attribute()] . "'. ". implode(', ', $failure->errors());
                    }

                    return back()->with(['error' => 'Kesalahan validasi: ' . implode('<br>', $errorMessages)]);
                }

            } catch (\Exception $e) {
                DB::rollBack();
                // dd($e);
                if(Str::contains($e->getMessage(), "Undefined array key")) {
                    return back()->with(['error' => 'Kesalahan: Kolom File Excel tidak lengkap : "' . $e->getMessage() . '".']);
                } else {
                    return back()->with(['error' => 'Kesalahan: ' . $e->getMessage()]);
                }
                
            }
        }

        return back()->with(['error' => 'Tidak ada file yang diunggah.']);
    }

    public function getDoubleCallsign(Request $request)
    {
        $dtAssign = DB::table('data_assign_tims')
                ->select('tgl_ikr','branch','leader','callsign','tek1_nik', 'teknisi1','tek2_nik', 'teknisi2','tek3_nik', 'teknisi3','tek4_nik', 'teknisi4')
                ->where('tgl_ikr','2025-01-12')->distinct()->get();

        $dtImport = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','callsign','tek1_nik', 'teknisi1','tek2_nik', 'teknisi2','tek3_nik', 'teknisi3','tek4_nik', 'teknisi4')
                ->where('tgl_ikr','2025-01-12')->distinct()->get()->toArray();

        $dtImportTek1 = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek1_nik', 'teknisi1')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek1_nik')->distinct();

        $dtImportTek2 = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek2_nik', 'teknisi2')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek2_nik')->distinct();

        $dtImportTek3 = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek3_nik', 'teknisi3')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek3_nik')->distinct();

        $dtImportTek = DB::table('import_assign_tims')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek4_nik as tek_nik', 'teknisi4 as teknisi')
                ->where('tgl_ikr','2025-01-12')->whereNotNull('tek4_nik')
                ->union($dtImportTek1)
                ->union($dtImportTek2)
                ->union($dtImportTek3)
                ->distinct()->orderBy('callsign')->get();

        for($x=0; $x < count($dtImportTek); $x++) {
            // dd($dtImportTek[$x]);
            $dtAssignTek = DB::table('v_rekap_assign')
                ->where('tgl_ikr', $dtImportTek[$x]->tgl_ikr)
                ->where('branch', $dtImportTek[$x]->branch)
                ->where('callsign', $dtImportTek[$x]->callsign)
                ->where('tek_nik', $dtImportTek[$x]->tek_nik)
                ->get();

            if(count($dtAssignTek) == 0) {
                $dtAssign = DB::table('v_rekap_assign_tim')
                    ->select('tgl_ikr','branch','leader','callsign', 'teknisi1', 'teknisi2', 'teknisi3', 'teknisi4')
                    ->where('tgl_ikr', $dtImportTek[$x]->tgl_ikr)
                    ->where('callsign', $dtImportTek[$x]->callsign )->distinct()->get();
            }
        }

        dd("stop");

        $dtAssignTek = DB::table('v_rekap_assign')
                ->select('tgl_ikr','branch','leadcall','leader','callsign','tek_nik', 'teknisi')
                ->where('tgl_ikr', '2025-01-12')->get();


        // $diff = $dtImport->diff($dtAssign);
        dd($dtImportTek, $dtAssignTek);
        $differenceArray = array_diff($dtAssign, $dtImport);
        dd($differenceArray);
        return response()->json($dtAssign);
    }

    public function getDataImportWo(Request $request)
    {

        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_assign_tims')->where('login', '=', $akses)->orderBy('fat_code_apk')->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-importWo" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-importWo mb-0" >Detail</a>';
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

    public function getDetailImport(Request $request)
    {
        // dd($request->all());
        $wo_id = $request->filWoId;
        $datas = DB::table('import_assign_tims as d')
            ->where('d.id', $wo_id)->first();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance','Teknisi'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->where('status_active','=','Aktif')
            ->orderBy('nama_karyawan')
            ->get();

        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        return response()->json(['data' => $datas, 'tim' => $tim, 'LeadCall' => $Leadcallsign, 'callTim' => $callTim]);
    }

    public function simpanImportWo(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':

                if ($request->branchShow) {
                    $branchRq = explode('|', $request->branchShow);
                    $branchId = $branchRq[0];
                    $branch = $branchRq[1];
                } else {
                    $branch = "";
                }

                //get data import assign tim,
                $dtImportAssign = DB::table('import_assign_tims as iat')->whereNotNull('iat.callsign')
                    ->leftJoin('data_assign_tims as dat', function($join) {
                        $join->on(DB::raw('iat.no_wo_apk'),'=', 'dat.no_wo_apk');
                        $join->on(DB::raw('iat.tgl_ikr'),'=','dat.tgl_ikr');
                    })
                    ->leftJoin('data_ftth_mt_oris as dmt', function($jmt) {
                        $jmt->on('iat.no_wo_apk','=','dmt.no_wo');
                        $jmt->on('iat.tgl_ikr','=','dmt.tgl_ikr');
                    })
                    ->leftJoin('data_ftth_ib_oris as dib', function($jib) {
                        $jib->on('iat.no_wo_apk','=','dib.no_wo');
                        $jib->on('iat.tgl_ikr','=','dib.tgl_ikr');
                    })
                    ->leftJoin('data_ftth_dismantle_oris as ddis', function($jdis) {
                        $jdis->on('iat.no_wo_apk','=','ddis.no_wo');
                        $jdis->on('iat.tgl_ikr','=','ddis.visit_date');
                    })
                    ->select(
                        'dat.id as assign_id', 'dmt.id as mt_id', 'dib.id as ib_id', 'ddis.id as dis_id','iat.batch_wo', 'iat.tgl_ikr', 'iat.slot_time', 'iat.type_wo', 'iat.no_wo_apk', 'iat.no_ticket_apk',
                        'iat.wo_date_apk', 'iat.cust_id_apk', 'iat.name_cust_apk', 'iat.cust_phone_apk', 'iat.cust_mobile_apk',
                        'iat.address_apk', 'iat.area_cluster_apk', 'iat.wo_type_apk', 'iat.fat_code_apk', 'iat.fat_port_apk',
                        'iat.remarks_apk', 'iat.vendor_installer_apk', 'iat.ikr_date_apk', 'iat.time_apk', 'iat.branch_id',
                        'iat.branch', 'iat.leadcall_id', 'iat.leadcall', 'iat.leader_id', 'iat.leader', 'iat.callsign_id',
                        'iat.callsign', 'iat.tek1_nik', 'iat.teknisi1', 'iat.tek2_nik', 'iat.teknisi2', 'iat.tek3_nik', 'iat.teknisi3',
                        'iat.tek4_nik', 'iat.teknisi4', 'iat.login_id', 'iat.login', 'iat.cek_telebot', 'iat.status_telebot'
                    )
                    ->where('iat.login', $akses)
                    ->get()->toArray();

                //get data callsign tim dari data import assign tim, sebagai acuan untuk update callsign tim di data assign tim

                // dd($dtImportAssign, $dtImportCallsign);

                if (count($dtImportAssign) > 0) {

                    DB::beginTransaction();

                    try {

                        $doubleAssign = [];
                        $AssignBaru = [];
                        $AssignBaruMT = [];
                        $AssignBaruIB = [];
                        $AssignBaruDis = [];

                        $callsignBaru = [];
                        $callsignBaruMT = [];
                        $callsignBaruIB = [];
                        $callsignBaruDis = [];

                        foreach ($dtImportAssign as $data) {
                            // $cekDoubleAssign = DataAssignTim::where('no_wo_apk', $data['no_wo_apk'])
                            //     ->where('tgl_ikr', $data['tgl_ikr'])
                            //     ->first();

                            $kdArea = substr(trim($data->fat_code_apk),4,3);
                            $kategori_area = DB::table('list_fat')->where('branch', $data->branch)
                                            ->select('kategori_area')->distinct()->first();

                            $areaSegmen = DB::table('list_fat')->where('kategori_area', $kategori_area->kategori_area)
                                        ->where('kode_area', $kdArea)
                                        ->where('branch', $data->branch)->first();

                            array_push($AssignBaru, ['id' => $data->assign_id, 'no_wo_apk' => $data->no_wo_apk, 'tgl_ikr' => $data->tgl_ikr,
                                        'batch_wo' => $data->batch_wo,
                                        'slot_time' => $data->slot_time,
                                        'type_wo' => $data->type_wo,
                                        'no_ticket_apk' => $data->no_ticket_apk,
                                        'wo_date_apk' => $data->wo_date_apk,
                                        'cust_id_apk' => $data->cust_id_apk,
                                        'name_cust_apk' => $data->name_cust_apk,
                                        'cust_phone_apk' => $data->cust_phone_apk,
                                        'cust_mobile_apk' => $data->cust_mobile_apk,
                                        'address_apk' => $data->address_apk,
                                        // 'area_cluster_apk' => $data->area_cluster_apk,
                                        'area_cluster_apk' => isset($areaSegmen->cluster) ? $areaSegmen->cluster : $data->area_cluster_apk,
                                        'wo_type_apk' => $data->wo_type_apk,
                                        'fat_code_apk' => $data->fat_code_apk,
                                        'fat_port_apk' => $data->fat_port_apk,
                                        'remarks_apk' => $data->remarks_apk,
                                        'vendor_installer_apk' => $data->vendor_installer_apk,
                                        'ikr_date_apk' => $data->ikr_date_apk,
                                        'time_apk' => $data->time_apk,
                                        'branch_id' => $data->branch_id,
                                        'branch' => $data->branch,
                                        'leadcall_id' => $data->leadcall_id,
                                        'leadcall' => $data->leadcall,
                                        'leader_id' => $data->leader_id,
                                        'leader' => $data->leader,
                                        'callsign_id' => $data->callsign_id,
                                        'callsign' => $data->callsign,
                                        'tek1_nik' => $data->tek1_nik,
                                        'teknisi1' => $data->teknisi1,
                                        'tek2_nik' => $data->tek2_nik,
                                        'teknisi2' => $data->teknisi2,
                                        'tek3_nik' => $data->tek3_nik,
                                        'teknisi3' => $data->teknisi3,
                                        'tek4_nik' => $data->tek4_nik,
                                        'teknisi4' => $data->teknisi4,
                                        'login_id' => $data->login_id,
                                        'login' => $data->login,
                                        'cek_telebot' => $data->cek_telebot,
                                        'status_telebot' => $data->status_telebot,
                                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()]
                                ]);

                                if ($data->type_wo == "FTTH Maintenance") {
                                    // DB::table('data_ftth_mt_oris')->insert([
                                        $AssignBaruMT[] = ['id' => $data->mt_id, 'no_wo' => $data->no_wo_apk, 'tgl_ikr' => $data->tgl_ikr,
                                            'type_wo' => $data->type_wo,
                                            'no_ticket' => $data->no_ticket_apk,
                                            'cust_id' => $data->cust_id_apk,
                                            'nama_cust' => $data->name_cust_apk,
                                            'cust_address1' => $data->address_apk,
                                            'cust_address2' => $data->address_apk,
                                            'type_maintenance' => $data->remarks_apk,
                                            'kode_fat' => $data->fat_code_apk,
                                            'kode_wilayah' => isset($kdArea) ? $kdArea: null,
                                            'cluster' => isset($areaSegmen->cluster) ? $areaSegmen->cluster : $data->area_cluster_apk,
                                            'kotamadya' => isset($areaSegmen->kotamadya) ? $areaSegmen->kotamadya : null,
                                            'kotamadya_penagihan' => isset($areaSegmen->kotamadya_penagihan) ? $areaSegmen->kotamadya_penagihan: null,
                                            'branch_id' => $data->branch_id,
                                            'branch' => $data->branch,
                                            'slot_time_leader' => $data->slot_time,
                                            'slot_time_apk' => $data->time_apk,
                                            'sesi' => $data->batch_wo,
                                            'callsign' => $data->callsign,
                                            'leader' => $data->leader,
                                            'teknisi1' => $data->teknisi1,
                                            'teknisi2' => $data->teknisi2,
                                            'teknisi3' => $data->teknisi3,
                                            // 'status_wo' => "Requested",
                                            // 'status_apk' => "Requested",
                                            'ms_regular' => isset($areaSegmen->status_ms) ? $areaSegmen->status_ms : null,
                                            'wo_date_apk' => $data->wo_date_apk,
                                            'slot_time_assign_apk' => implode(" ", [$data->tgl_ikr, $data->time_apk]),
                                            'port_fat' => $data->fat_port_apk,
                                            'site_penagihan' => isset($areaSegmen->site) ? $areaSegmen->site : null,
                                            'wo_type_apk' => $data->wo_type_apk,
                                            'leadcall_id' => $data->leadcall_id,
                                            'leadcall' => $data->leadcall,
                                            'leader_id' => $data->leader_id,
                                            'callsign_id' => $data->callsign_id,
                                            'tek1_nik' => $data->tek1_nik,
                                            'tek2_nik' => $data->tek2_nik,
                                            'tek3_nik' => $data->tek3_nik,
                                            'tek4_nik' => $data->tek4_nik,
                                            'teknisi4' => $data->teknisi4,
                                            // 'is_checked' => 0,
                                            'login' => $data->login,
                                            'cek_telebot' => $data->cek_telebot,
                                            'hasil_cek_telebot' => $data->status_telebot,
                                            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                                        ];
                                } elseif ($data->type_wo == 'FTTH New Installation') {
                                    // DB::table('data_ftth_ib_oris')->insert([
                                        $AssignBaruIB[] =
                                        ['id' => $data->ib_id, 'no_wo' => $data->no_wo_apk,'tgl_ikr' => $data->tgl_ikr,
                                        'site' => isset($areaSegmen->site) ? $areaSegmen->site : null,
                                        'site_penagihan' => isset($areaSegmen->site) ? $areaSegmen->site : null,
                                        'type_wo' => $data->type_wo,
                                        'wo_type_apk' => $data->wo_type_apk,

                                        'no_ticket' => $data->no_ticket_apk,
                                        'cust_id' => $data->cust_id_apk,
                                        'nama_cust' => $data->name_cust_apk,
                                        'cust_phone_apk' => $data->cust_phone_apk,
                                        'cust_address1' => $data->address_apk,
                                        'type_maintenance' => $data->remarks_apk,
                                        'kode_fat' => $data->fat_code_apk,

                                        'kode_wilayah' => isset($kdArea) ? $kdArea: null,
                                        'cluster' => isset($areaSegmen->cluster) ? $areaSegmen->cluster : $data->area_cluster_apk,
                                        'kotamadya' => isset($areaSegmen->kotamadya) ? $areaSegmen->kotamadya : null,
                                        'kotamadya_penagihan' => isset($areaSegmen->kotamadya_penagihan) ? $areaSegmen->kotamadya_penagihan: null,

                                        'branch_id' => $data->branch_id,
                                        'branch' => $data->branch,
                                        'leadcall_id' => $data->leadcall_id,
                                        'leadcall' => $data->leadcall,

                                        'slot_time_leader' => $data->slot_time,
                                        'slot_time_apk' => $data->time_apk,
                                        'sesi' => $data->batch_wo,
                                        'callsign' => $data->callsign,
                                        'callsign_id' => $data->callsign_id,
                                        'leader_id' => $data->leader_id,
                                        'leader' => $data->leader,
                                        'tek1_nik' => $data->tek1_nik,
                                        'tek2_nik' => $data->tek2_nik,
                                        'tek3_nik' => $data->tek3_nik,
                                        'tek4_nik' => $data->tek4_nik,
                                        'teknisi1' => $data->teknisi1,
                                        'teknisi2' => $data->teknisi2,
                                        'teknisi3' => $data->teknisi3,
                                        'teknisi4' => $data->teknisi4,
                                        'wo_date_apk' => $data->wo_date_apk,
                                        'port_fat' => $data->fat_port_apk,
                                        // 'status_wo' => "Requested",
                                        // 'status_apk' => "Requested",
                                        // 'is_checked' => 0,
                                        'login' => $data->login,
                                        'cek_telebot' => $data->cek_telebot,
                                        'hasil_cek_telebot' => $data->status_telebot,
                                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()]

                                    ];
                                } elseif ($data->type_wo == 'FTTH Dismantle') {
                                    // DB::table('data_ftth_dismantle_oris')->insert([
                                        $AssignBaruDis[] =
                                        ['id' => $data->dis_id, 'no_wo' => $data->no_wo_apk, 'visit_date' => $data->tgl_ikr,
                                        'sesi' => $data->batch_wo,

                                        'type_wo' => $data->type_wo,

                                        'no_ticket' => $data->no_ticket_apk,
                                        'wo_date' => $data->wo_date_apk,
                                        'cust_id' => $data->cust_id_apk,
                                        'nama_cust' => $data->name_cust_apk,
                                        'cust_address1' => $data->address_apk,
                                        'cluster' => isset($areaSegmen->cluster) ? $areaSegmen->cluster : $data->area_cluster_apk,
                                        'wo_type_apk' => $data->wo_type_apk,
                                        'kode_fat' => $data->fat_code_apk,
                                        'port_fat' => $data->fat_port_apk,
                                        'slot_time_leader' => $data->slot_time,
                                        'slot_time_apk' => $data->time_apk,
                                        // 'status_wo' => "Requested",
                                        // 'status_apk' => "Requested",
                                        'branch_id' => $data->branch_id,
                                        'main_branch' => $data->branch,
                                        'leadcall_id' => $data->leadcall_id,
                                        'leadcall' => $data->leadcall,
                                        'leader_id' => $data->leader_id,
                                        'leader' => $data->leader,
                                        'callsign_id' => $data->callsign_id,
                                        'callsign' => $data->callsign,
                                        'tek1_nik' => $data->tek1_nik,
                                        'teknisi1' => $data->teknisi1,
                                        'tek2_nik' => $data->tek2_nik,
                                        'teknisi2' => $data->teknisi2,
                                        'tek3_nik' => $data->tek3_nik,
                                        'teknisi3' => $data->teknisi3,
                                        'login' => $data->login,
                                        'cek_telebot' => $data->cek_telebot,
                                        'hasil_cek_telebot' => $data->status_telebot,
                                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                                        "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()]

                                    ];
                                }
                            // }
                        }

                        // update / insert data assign wo
                        if(count($AssignBaru)>0) {

                            // $insertAssign = DB::table('data_assign_tims')->insert($AssignBaru);
                            $insertAssign = DB::table('data_assign_tims')->upsert(
                                $AssignBaru, ['id'],['no_wo_apk', 'tgl_ikr', 'batch_wo', 'slot_time', 'type_wo',
                                        'no_ticket_apk', 'wo_date_apk', 'cust_id_apk', 'name_cust_apk', 'cust_phone_apk',
                                        'cust_mobile_apk', 'address_apk', 'area_cluster_apk', 'wo_type_apk', 'fat_code_apk',
                                        'fat_port_apk', 'remarks_apk', 'vendor_installer_apk', 'ikr_date_apk', 'time_apk',
                                        'branch_id', 'branch', 'leadcall_id', 'leadcall', 'leader_id', 'leader', 'callsign_id',
                                        'callsign', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2', 'tek3_nik', 'teknisi3',
                                        'tek4_nik', 'teknisi4', 'login_id', 'login', 'cek_telebot', 'status_telebot', 'created_at', 'updated_at'
                                ]);
                        }

                        if(count($AssignBaruMT)>0) {
                            // $insertMt = DB::table('data_ftth_mt_oris')->insert($AssignBaruMT);
                            $insertMt = DB::table('data_ftth_mt_oris')->upsert(
                                $AssignBaruMT,['id'],
                                ['no_wo', 'tgl_ikr', 'type_wo', 'no_ticket', 'cust_id', 'nama_cust','cust_address1',
                                    'cust_address2', 'type_maintenance', 'kode_fat', 'kode_wilayah','cluster',
                                    'kotamadya', 'kotamadya_penagihan', 'branch_id', 'branch', 'slot_time_leader',
                                    'slot_time_apk', 'sesi', 'callsign', 'leader', 'teknisi1', 'teknisi2', 'teknisi3',// 'status_wo' => "Requested", 'status_apk' => "Requested",
                                    'ms_regular', 'wo_date_apk', 'slot_time_assign_apk', 'port_fat', 'site_penagihan',
                                    'wo_type_apk', 'leadcall_id', 'leadcall', 'leader_id', 'callsign_id', 'tek1_nik',
                                    'tek2_nik', 'tek3_nik', 'tek4_nik', 'teknisi4', // 'is_checked' => 0,
                                    'login', 'cek_telebot', 'hasil_cek_telebot',  "created_at", "updated_at"
                                ]
                            );
                        }
                        if(count($AssignBaruIB)>0) {
                            // $insertIB = DB::table('data_ftth_ib_oris')->insert($AssignBaruIB);
                            $insertIB = DB::table('data_ftth_ib_oris')->upsert(

                                $AssignBaruIB, ['id'], 
                                ['no_wo', 'tgl_ikr', 'site', 'site_penagihan', 'type_wo', 'wo_type_apk', 'no_ticket', 'cust_id', 'nama_cust', 'cust_address1',
                                        'type_maintenance', 'kode_fat', 'kode_wilayah', 'cluster', 'kotamadya', 'kotamadya_penagihan', 'branch_id',
                                        'branch', 'leadcall_id', 'leadcall', 'slot_time_leader', 'slot_time_apk', 'sesi', 'callsign', 'callsign_id',
                                        'leader_id', 'leader', 'tek1_nik', 'tek2_nik', 'tek3_nik', 'tek4_nik', 'teknisi1', 'teknisi2', 'teknisi3', 'teknisi4',
                                        'wo_date_apk', 'port_fat', // 'status_wo' => "Requested", 'status_apk' => "Requested",
                                        'login', 'cek_telebot', 'hasil_cek_telebot', "created_at", "updated_at"
                                ]

                            );
                        }
                        if(count($AssignBaruDis)>0) {
                            // $insertDis = DB::table('data_ftth_dismantle_oris')->insert($AssignBaruDis);
                            $insertDis = DB::table('data_ftth_dismantle_oris')->upsert(
                                $AssignBaruDis, ['id'],
                                ['no_wo', 'visit_date', 'sesi', 'type_wo', 'no_ticket', 'wo_date', 'cust_id', 'nama_cust',
                                        'cust_address1', 'cluster', 'wo_type_apk', 'kode_fat', 'port_fat', 'slot_time_leader', 'slot_time_apk', // 'status_wo' => "Requested",'status_apk' => "Requested",
                                        'branch_id', 'main_branch', 'leadcall_id', 'leadcall', 'leader_id', 'leader', 'callsign_id', 'callsign',
                                        'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2', 'tek3_nik', 'teknisi3', 'tek4_nik', 'teknisi4', 'login', 'cek_telebot', 'hasil_cek_telebot', "created_at", "updated_at"
                                ]
                            );
                        }


                        //bagian update callsign jika ada perubahan callsign dan hanya import batch terakhir
                        $dtImportCallsign = DB::table('import_assign_tims as iat')->whereNotNull('iat.callsign')
                            ->join('data_assign_tims as dat', function($join) {
                                $join->on(DB::raw('iat.callsign'),'=', 'dat.callsign');
                                $join->on(DB::raw('iat.tgl_ikr'),'=','dat.tgl_ikr');
                            })
                            ->select(
                                'dat.id as id',
                                'iat.no_wo_apk', 'iat.cust_id_apk', 'iat.name_cust_apk', 'iat.area_cluster_apk', 'iat.fat_code_apk', 'iat.vendor_installer_apk',
                                'iat.tgl_ikr', 'iat.branch', 'iat.branch_id', 'iat.leadcall_id', 'iat.leadcall', 'iat.leader_id','iat.leader',
                                'iat.callsign_id', 'iat.callsign', 'iat.tek1_nik', 'iat.teknisi1', 'iat.tek2_nik', 'iat.teknisi2',
                                'iat.tek3_nik', 'iat.teknisi3', 'iat.tek4_nik', 'iat.teknisi4', 'iat.login_id', 'iat.login'
                            )
                            ->where('iat.login', $akses)
                            ->distinct()->get()->toArray();


                        // dd(collect($dtImportCallsign));
                        //update selurun callsign tim di data assign tim jika ada perubahan tim di callsign
                        if(count($dtImportCallsign)>0) {
                            $callsignAssign = $dtImportCallsign;

                            foreach($dtImportCallsign as $data) {
                                array_push($callsignBaru, [
                                    'id' => $data->id,
                                    'no_wo_apk' => $data->no_wo_apk,
                                    'cust_id_apk' => $data->cust_id_apk,
                                    'name_cust_apk' => $data->name_cust_apk,
                                    'area_cluster_apk' => $data->area_cluster_apk,
                                    'fat_code_apk' => $data->fat_code_apk,
                                    'vendor_installer_apk' => $data->vendor_installer_apk,
                                    'tgl_ikr' => $data->tgl_ikr,
                                    'branch_id' => $data->branch_id,
                                    'branch' => $data->branch,
                                    'leadcall_id' => $data->leadcall_id,
                                    'leadcall' => $data->leadcall,
                                    'leader_id' => $data->leader_id,
                                    'leader' => $data->leader,
                                    'callsign_id' => $data->callsign_id,
                                    'callsign' => $data->callsign,
                                    'tek1_nik' => $data->tek1_nik,
                                    'teknisi1' => $data->teknisi1,
                                    'tek2_nik' => $data->tek2_nik,
                                    'teknisi2' => $data->teknisi2,
                                    'tek3_nik' => $data->tek3_nik,
                                    'teknisi3' => $data->teknisi3,
                                    'tek4_nik' => $data->tek4_nik,
                                    'teknisi4' => $data->teknisi4,
                                    'login_id' => $data->login_id,
                                    'login' => $data->login]);
                            }


                            // dd($callsignBaru);
                            // foreach ($dtImportCallsign as $impCallsign ) {
                            $updateDtCallsign = DB::table('data_assign_tims')->upsert(
                                $callsignBaru, ['id'],
                                ['callsign', 'leadcall_id', 'leadcall', 'leader_id','leader',
                                    'callsign_id', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2',
                                    'tek3_nik', 'teknisi3', 'tek4_nik', 'teknisi4'
                                ]);

                        }


                        $dtImportCallsignMt = DB::table('import_assign_tims as iat')->whereNotNull('iat.callsign')
                            ->join('data_ftth_mt_oris as dmt', function($jmt) {
                                $jmt->on('iat.callsign','=','dmt.callsign');
                                $jmt->on('iat.tgl_ikr','=','dmt.tgl_ikr');
                        })
                        ->select(
                            'dmt.id as id',
                            'iat.no_wo_apk', 'iat.cust_id_apk', 'iat.name_cust_apk', 'iat.area_cluster_apk', 'iat.fat_code_apk', 'iat.vendor_installer_apk',
                            'iat.tgl_ikr', 'iat.branch', 'iat.branch_id', 'iat.leadcall_id', 'iat.leadcall', 'iat.leader_id','iat.leader',
                            'iat.callsign_id', 'iat.callsign', 'iat.tek1_nik', 'iat.teknisi1', 'iat.tek2_nik', 'iat.teknisi2',
                            'iat.tek3_nik', 'iat.teknisi3', 'iat.tek4_nik', 'iat.teknisi4', 'iat.login_id', 'iat.login'
                        )
                        ->where('iat.login', $akses)
                        ->distinct()->get()->toArray();

                        // dd($dtImportCallsignMt);

                        if(count($dtImportCallsignMt)>0) {

                            foreach($dtImportCallsignMt as $data) {
                                array_push($callsignBaruMT, [
                                    'id' => $data->id,
                                    'no_wo' => $data->no_wo_apk,
                                    'cust_id' => $data->cust_id_apk,
                                    'nama_cust' => $data->name_cust_apk,
                                    'cluster' => $data->area_cluster_apk,
                                    'kode_fat' => $data->fat_code_apk,
                                    // 'vendor_installer_apk' => $data->vendor_installer_apk,
                                    'tgl_ikr' => $data->tgl_ikr,
                                    'branch_id' => $data->branch_id,
                                    'branch' => $data->branch,
                                    'leadcall_id' => $data->leadcall_id,
                                    'leadcall' => $data->leadcall,
                                    'leader_id' => $data->leader_id,
                                    'leader' => $data->leader,
                                    'callsign_id' => $data->callsign_id,
                                    'callsign' => $data->callsign,
                                    'tek1_nik' => $data->tek1_nik,
                                    'teknisi1' => $data->teknisi1,
                                    'tek2_nik' => $data->tek2_nik,
                                    'teknisi2' => $data->teknisi2,
                                    'tek3_nik' => $data->tek3_nik,
                                    'teknisi3' => $data->teknisi3,
                                    'tek4_nik' => $data->tek4_nik,
                                    'teknisi4' => $data->teknisi4,
                                    // 'login_id' => $data->login_id,
                                    'login' => $data->login]);
                            }

                            $updateMTDtCallsign = DB::table('data_ftth_mt_oris')->upsert(
                                $callsignBaruMT, ['id'],
                                ['callsign', 'leadcall_id', 'leadcall', 'leader_id', 'leader',
                                    'callsign_id', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2',
                                    'tek3_nik', 'teknisi3', 'tek4_nik', 'teknisi4'

                                ]);
                        }


                        $dtImportCallsignIb = DB::table('import_assign_tims as iat')->whereNotNull('iat.callsign')
                            ->join('data_ftth_ib_oris as dib', function($jib) {
                                $jib->on('iat.callsign','=','dib.callsign');
                                $jib->on('iat.tgl_ikr','=','dib.tgl_ikr');
                        })
                        ->select(
                            'dib.id as id',
                            'iat.no_wo_apk', 'iat.cust_id_apk', 'iat.name_cust_apk', 'iat.area_cluster_apk', 'iat.fat_code_apk', 'iat.vendor_installer_apk',
                            'iat.tgl_ikr', 'iat.branch', 'iat.branch_id', 'iat.leadcall_id', 'iat.leadcall', 'iat.leader_id','iat.leader',
                            'iat.callsign_id', 'iat.callsign', 'iat.tek1_nik', 'iat.teknisi1', 'iat.tek2_nik', 'iat.teknisi2',
                            'iat.tek3_nik', 'iat.teknisi3', 'iat.tek4_nik', 'iat.teknisi4', 'iat.login_id', 'iat.login'
                        )
                        ->where('iat.login', $akses)
                        ->distinct()->get()->toArray();

                        // dd($dtImportCallsignIb);
                        if(count($dtImportCallsignIb)>0) {

                            foreach($dtImportCallsignIb as $data) {
                                array_push($callsignBaruIB, [
                                    'id' => $data->id,
                                    'no_wo' => $data->no_wo_apk,
                                    'cust_id' => $data->cust_id_apk,
                                    'nama_cust' => $data->name_cust_apk,
                                    'cluster' => $data->area_cluster_apk,
                                    'kode_fat' => $data->fat_code_apk,
                                    // 'vendor_installer_apk' => $data->vendor_installer_apk,
                                    'tgl_ikr' => $data->tgl_ikr,
                                    'branch_id' => $data->branch_id,
                                    'branch' => $data->branch,
                                    'leadcall_id' => $data->leadcall_id,
                                    'leadcall' => $data->leadcall,
                                    'leader_id' => $data->leader_id,
                                    'leader' => $data->leader,
                                    'callsign_id' => $data->callsign_id,
                                    'callsign' => $data->callsign,
                                    'tek1_nik' => $data->tek1_nik,
                                    'teknisi1' => $data->teknisi1,
                                    'tek2_nik' => $data->tek2_nik,
                                    'teknisi2' => $data->teknisi2,
                                    'tek3_nik' => $data->tek3_nik,
                                    'teknisi3' => $data->teknisi3,
                                    'tek4_nik' => $data->tek4_nik,
                                    'teknisi4' => $data->teknisi4,
                                    // 'login_id' => $data->login_id,
                                    'login' => $data->login]);
                            }

                            $updateIBDtCallsign = DB::table('data_ftth_ib_oris')->upsert(
                                $callsignBaruIB,['id'],
                                ['callsign', 'leadcall_id', 'leadcall', 'leader_id', 'leader',
                                'callsign_id', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2',
                                'tek3_nik', 'teknisi3', 'tek4_nik', 'teknisi4'
                            ]);
                        }

                        $dtImportCallsignDis = DB::table('import_assign_tims as iat')->whereNotNull('iat.callsign')
                            ->join('data_ftth_dismantle_oris as ddis', function($jdis) {
                                $jdis->on('iat.callsign','=','ddis.callsign');
                                $jdis->on('iat.tgl_ikr','=','ddis.visit_date');
                            })
                            ->select(
                                'ddis.id as id',
                                'iat.tgl_ikr as visit_date', 'iat.branch', 'iat.leadcall_id', 'iat.leadcall', 'iat.leader_id','iat.leader',
                                'iat.callsign_id', 'iat.callsign', 'iat.tek1_nik', 'iat.teknisi1', 'iat.tek2_nik', 'iat.teknisi2',
                                'iat.tek3_nik', 'iat.teknisi3', 'iat.tek4_nik', 'iat.teknisi4', 'iat.login_id','iat.login'
                            )
                            ->where('iat.login', $akses)
                            ->distinct()->get()->toArray();

                        // dd($dtImportCallsignDis);
                        if(count($dtImportCallsignDis)>0) {

                            foreach($dtImportCallsignIb as $data) {
                                array_push($callsignBaruIB, [
                                    'id' => $data->id,
                                    'no_wo' => $data->no_wo_apk,
                                    'cust_id' => $data->cust_id_apk,
                                    'nama_cust' => $data->name_cust_apk,
                                    'cluster' => $data->area_cluster_apk,
                                    'kode_fat' => $data->fat_code_apk,
                                    // 'vendor_installer_apk' => $data->vendor_installer_apk,
                                    'visit_date' => $data->tgl_ikr,
                                    'branch_id' => $data->branch_id,
                                    'branch' => $data->branch,
                                    'leadcall_id' => $data->leadcall_id,
                                    'leadcall' => $data->leadcall,
                                    'leader_id' => $data->leader_id,
                                    'leader' => $data->leader,
                                    'callsign_id' => $data->callsign_id,
                                    'callsign' => $data->callsign,
                                    'tek1_nik' => $data->tek1_nik,
                                    'teknisi1' => $data->teknisi1,
                                    'tek2_nik' => $data->tek2_nik,
                                    'teknisi2' => $data->teknisi2,
                                    'tek3_nik' => $data->tek3_nik,
                                    'teknisi3' => $data->teknisi3,
                                    'tek4_nik' => $data->tek4_nik,
                                    'teknisi4' => $data->teknisi4,
                                    // 'login_id' => $data->login_id,
                                    'login' => $data->login]);
                            }

                            $updateDisDtCallsign = DB::table('data_ftth_dismantle_oris')->upsert(
                                $callsignBaruDis, ['id'],
                                ['callsign', 'leadcall_id', 'leadcall', 'leader_id', 'leader',
                                'callsign_id', 'tek1_nik', 'teknisi1', 'tek2_nik', 'teknisi2',
                                'tek3_nik', 'teknisi3', 'tek4_nik', 'teknisi4'
                            ]);
                        }

                        // Hapus data sementara yang sudah diproses
                        ImportAssignTim::where('login', $akses) //whereNotIn('no_wo_apk', $doubleAssign)
                            ->delete();

                        DB::commit();

                        // Cek apakah ada duplikasi
                        // if (count($doubleAssign) > 0) {
                        //     $warningMessage = 'Beberapa No WO sudah ada di assign tim: ' . implode(', ', $doubleAssign);
                        //     return redirect()->route('assignTim')
                        //         ->with(['success' => 'Data tersimpan sebagian.'. $warningMessage])
                        //         ->with(['warning' => $warningMessage]);
                        // } else {
                        //     return redirect()->route('assignTim')
                        //         ->with(['success' => 'Data tersimpan.']);
                        // }

                        return redirect()->route('rekapAssignTim')
                                ->with(['success' => 'Data tersimpan.']);
                    } catch (\Throwable $e) {

                        DB::rollBack();
                        // dd($kdArea);
                        return redirect()->route('importDataWo')
                            ->with(['error' => 'Gagal Simpan Dataa: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('importDataWo')
                        ->with(['error' => 'Data WO tidak ada assign tim.']);
                }
                break;

            case 'batal':
                ImportAssignTim::where('login', $akses)->delete();
                return redirect()->route('assignTim');
                break;
        }
    }



    public function updateImportWo(Request $request)
    {
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $imp_id = $request->detId;

        if ($request->branchShow) {
            $ReqBranch = explode('|', $request->branchShow);
            $branchId = $ReqBranch[0];
            $branchNm = $ReqBranch[1];
        }

        if ($request->LeadCallsignShow) {
            $ReqLeadCall = explode('|', $request->LeadCallsignShow);
            $leadCallId = $ReqLeadCall[0];
            $leadCall = $ReqLeadCall[1];
            $leaderId = $ReqLeadCall[2];
            $leader = $ReqLeadCall[3];
        } else {
            $leadCallId = $request->LeadCallsignShow;
            $leadCall = $request->LeadCallsignShow;
            $leaderId = $request->leaderidShow;
            $leader = $request->leaderShow;
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

        $dataImport = ImportAssignTim::findOrFail($imp_id);

        $updateImportWo = $dataImport->update([
            'batch_wo' => $request['sesiShow'],
            'tgl_ikr' => $request['tglProgressShow'],
            'slot_time' => $request['slotTimeShow'],
            'type_wo' => $request['jenisWoShow'],
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $leaderId,
            'leader' => $leader,
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

        if ($updateImportWo) {
            return response()->json(['success' => 'Data tersimpan.', 'brImport' => $request->branchShow]);
        } else {
            return response()->json(['error' => 'Gagal Simpan Data.', 'brImport' => $request->branchShow]);
        }
    }

    public function getMaterial(Request $request)
    {
        $wo_no = "WO-24102024-2112494"; // contoh WO No

        $ftth_material = DB::table('ftth_materials')
            ->select(
                'wo_no',
                'installation_date',
                'status_item',
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN description END AS merk_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN sn END AS sn_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN mac_address END AS mac_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%STB%" THEN description END AS stb_merk_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%PRECON%" THEN description END AS precon_out'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%STB%" THEN description END AS stb_merk_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN description END AS merk_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN sn END AS sn_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN mac_address END AS mac_ont_in')
            )
            ->where('wo_no', $wo_no)
            ->get();

        return $ftth_material;

    }

}
